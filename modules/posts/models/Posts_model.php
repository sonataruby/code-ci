<?php
use \Sonata\Model;

class Posts_model extends Model{
	private $table = "posts";
	private $table_gallery = "gallery";
	private $table_gallery_image = "gallery_image";
	private $postInCatalog = "posts_incatalog";
	
	function __construct()
	{
	    parent::__construct();
	    $this->setExcel([
	    	"post_id" => "id",
	    	"post_title" => "title",
	    	"post_url" => "title_url",
	    	"post_tag" => "tags",
	    	"post_content" => "content",
	    	"post_description" => "description",
	    	"post_image" => "image",
	    	"created_date" => "datetime",
	    	"updated_date" => "datetime",
	    	"channel" => @$this->input->get("channel"),
	    	"account_id" => "athour_id",
	    	"language" => config_item("language")
	    ]);
	}


	public function create($id=false, $arv=[], $catalog=[]){
		$arv["post_url"] = $this->makeURL($arv["post_title"], @$arv["post_url"], $id);
		if($id){
			$arv["updated_date"] = getDateSQL();
			$this->db->update($this->table, $arv,["post_id" => $id]);
		}else{
			$arv["created_date"] = getDateSQL();
			$arv["updated_date"] = getDateSQL();
			$arv['post_description'] = substr(strip_tags(@$arv['post_content']),0,500);
			$arv["account_id"] = is_login();
			$this->db->insert($this->table, $arv);
			$id = $this->db->insert_id();
		}
		$this->posts_to_catalog($id, $catalog);
		return $id;
	}

	private function posts_to_catalog($post_id, $catalog=[]){

		$this->db->delete($this->postInCatalog,["post_id" => $post_id]);
		if(is_array($catalog)){
			foreach ($catalog as $key => $value) {
				$this->db->insert($this->postInCatalog, ["catalog_id" => $value, "post_id" => $post_id]);
			}
		}

	}


	public function getData($url="", $id=false, $prevnext=false, $order=false){
		
		//$readCache = $this->dbCache("posts-{$url}-{$id}");

		//if($readCache) return $readCache;

		if(!$url && !$id) return;
		if($url){
			$this->db->where("post_url", $url);
		}
		if($id){
			$this->db->where("post_id", $id);
		}
		$this->db->select("post_id as id, post_title as name, post_url as url, post_tag as tag, post_content as content, post_description as description, post_image as image, created_date, updated_date, views, channel, account_id");
		$data = $this->db->get($this->table)->row();
		if(!$data) return;
		$data->image = isObject($data->image);
		$data->tagURL = $this->renderTag($data->tag, $data->channel);
		$data->catalog = $this->db->select($this->postInCatalog.".post_id, ".$this->postInCatalog.".catalog_id, catalog.catalog_name as catalog_name, catalog.catalog_url as catalog_url, catalog.channel as channel")->join("catalog","catalog.catalog_id=".$this->postInCatalog.".catalog_id","left")->get_where($this->postInCatalog, ["post_id" => $data->id, "channel" => $data->channel])->result();

		if($prevnext){
			$data->prev = @array_pop($this->getList(["limit" => 1, "prev" => $data->id, "channel" => $data->channel]));
			$data->next = @array_pop($this->getList(["limit" => 1, "next" => $data->id, "channel" => $data->channel]));
		}
		
		if($order){
			$data->order = $this->getList(["limit" => 3, "ingore" => $data->id,"channel" => $data->channel]);
		}

		//$this->dbCache("posts-{$url}-{$id}", $data);

		return $data;
	}

	private function renderTag($test, $channel=""){
		$ex = explode(',', $test);
		$arv = [];
		foreach ($ex as $key => $value) {
			$arv[] = '<a href="'.site_url($channel."/post.html?tags=".trim($value)).'" title="Tag\'s '.$value.'">'.$value.'</a>';
		}
		return implode($arv, ", ");
	}

	public function getList($arv=[],$language=false){
		$language = ($language ? $language : $this->config->item("language"));

		

		$search = @$arv["search"];
		$tag = @$arv["tag"];
		$catalog = @$arv["catalog"];
		$sort = (@$arv["sort"] ? @$arv["sort"] : "post_id-DESC");
		$ingore = @$arv["ingore"];
		$prev = @$arv["prev"];
		$next = @$arv["next"];
		$channel = (@$arv["channel"] ? @$arv["channel"] : config_item("default_channel"));
		$pages = (@$arv["pages"] ? true : false);
		$limit = isset($arv["limit"]) ? intval($arv["limit"]) : 20;
		
		

		

		$this->setLimit($limit);
		$page = $this->input->get("page") ? intval($this->input->get("page")) : 1;
		$start = $page > 0 ? ($page - 1) * $limit : 0 * $limit;


		$this->db->where("language", $language);
		$this->db->select("{$this->table}.post_id as id, {$this->table}.post_image as image, {$this->table}.post_title as name, {$this->table}.post_description as description, {$this->table}.post_url as url, {$this->table}.post_tag as tag, {$this->table}.created_date, {$this->table}.updated_date, {$this->table}.views, {$this->table}.channel, {$this->table}.account_id");

		$this->db->limit($limit,$start);


		/*Sort*/
		list($sortfield, $sorttype) = explode('-', $sort);

		$this->db->order_by("{$this->table}.{$sortfield}", $sorttype);
		/*
		Search Query
		*/
		if(is_array($search)){
			foreach ($search as $key => $value) {
				$this->db->like("{$this->table}.{$key}", $value);
			}
		}else if($search){
			$this->db->like("{$this->table}.post_title", $search);
		}

		/*
		Tag query
		*/
		if($tag){
			if(is_array($tag)){
				foreach ($tag as $key => $value) {
					$this->db->like("{$this->table}.post_tag", $value);
				}
			}else{
				$this->db->like("{$this->table}.post_tag", $tag);
			}
		}

		if($catalog){
			$this->db->join("posts_incatalog","posts_incatalog.post_id={$this->table}.post_id","left");
			$this->db->where("posts_incatalog.catalog_id",$catalog);
		}

		if($ingore){
			$this->db->where("{$this->table}.post_id !=", $ingore);
		}

		if($prev){
			$this->db->order_by("{$this->table}.post_id","DESC");
			$this->db->where("{$this->table}.post_id <", $prev);
		}

		if($next){
			$this->db->order_by("{$this->table}.post_id","ASC");
			$this->db->where("{$this->table}.post_id >", $next);
		}

		if($channel){
			$this->db->where("{$this->table}.channel", $channel);

		}


		$data = $this->db->get($this->table)->result();
		if($pages){
			$this->setTotal($this->getNumRows($arv, $language));
		}

		$arv = [];
		foreach ($data as $key => $value) {
			$value->catalog = $this->db->select($this->postInCatalog.".post_id, ".$this->postInCatalog.".catalog_id, catalog.catalog_name as catalog_name, catalog.catalog_url as catalog_url, catalog.channel")->join("catalog","catalog.catalog_id=".$this->postInCatalog.".catalog_id","left")->get_where($this->postInCatalog, ["post_id" => $value->id])->result();
			$value->image = isObject($value->image);
			$arv[] = $value;
		}

		
		return $arv;
	}


	public function getNumRows($arv=[], $language=false){
		

		$search = @$arv["search"];
		$tag = @$arv["tag"];
		$catalog = @$arv["catalog"];
		
		$channel = (@$arv["channel"] ? @$arv["channel"] : config_item("default_channel"));

		/*
		Search Query
		*/
		if(is_array($search)){
			foreach ($search as $key => $value) {
				$this->db->like("{$this->table}.{$key}", $value);
			}
		}else if($search){
			$this->db->like("{$this->table}.post_title", $search);
		}

		/*
		Tag query
		*/
		if($tag){
			if(is_array($tag)){
				foreach ($tag as $key => $value) {
					$this->db->like("{$this->table}.post_tag", $value);
				}
			}else{
				$this->db->like("{$this->table}.post_tag", $tag);
			}
		}

		if($catalog){
			$this->db->join("posts_incatalog","posts_incatalog.post_id={$this->table}.post_id","left");
			$this->db->where("posts_incatalog.catalog_id",$catalog);
		}

		if($channel){
			$this->db->where("{$this->table}.channel", $channel);

		}

		$this->db->where("language", $language);

		return $this->db->get($this->table)->num_rows();
	}

	
	private function makeURL($name, $url, $id=false){
		if(trim($url)){
			$name = $url;
		}
		if($id > 0){
			$this->db->where("post_id !=",$id);
		}
		$url = url_title(convert_accented_characters($name),"-",true);
		$this->db->where("post_url", $url);
		$count = $this->db->get($this->table)->num_rows();

		return $url.($count > 0 ? "-".$count : "");
	}

	public function delete($id){
		$this->db->delete($this->table, ["post_id" => $id]);
		$this->db->delete($this->postInCatalog, ["post_id" => $id]);
	}

	
}