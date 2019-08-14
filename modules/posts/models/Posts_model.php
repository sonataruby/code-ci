<?php
use \Sonata\Model;

class Posts_model extends Model{
	private $table = "posts";
	private $table_gallery = "gallery";
	private $table_gallery_image = "gallery_image";
	private $postInCatalog = "posts_incatalog";

	public function create($id=false, $arv=[], $catalog=[]){
		$arv["post_url"] = $this->makeURL($arv["post_title"], @$arv["post_url"], $id);
		if($id){
			$arv["updated_date"] = getDateSQL();
			$this->db->update($this->table, $arv,["post_id" => $id]);
		}else{
			$arv["created_date"] = getDateSQL();
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
		if(!$url && !$id) return;
		if($url){
			$this->db->where("post_url", $url);
		}
		if($id){
			$this->db->where("post_id", $id);
		}
		$this->db->select("post_id as id, post_title as name, post_url as url, post_tag as tag, post_content as content, post_image as image, created_date, views, channel");
		$data = $this->db->get($this->table)->row();
		if(!$data) return;
		$data->image = isObject($data->image);
		$data->catalog = $this->db->select($this->postInCatalog.".post_id, ".$this->postInCatalog.".catalog_id, catalog.catalog_name as catalog_name, catalog.catalog_url as catalog_url")->join("catalog","catalog.catalog_id=".$this->postInCatalog.".catalog_id","left")->get_where($this->postInCatalog, ["post_id" => $data->id])->result();

		if($prevnext){
			$data->prev = @array_pop($this->getList(["limit" => 1, "prev" => $data->id]));
			$data->next = @array_pop($this->getList(["limit" => 1, "next" => $data->id]));
		}
		
		if($order){
			$data->order = $this->getList(["limit" => 3, "ingore" => $data->id]);
		}

		return $data;
	}

	public function getList($arv=[],$language=false){
		$language = ($language ? $language : $this->config->item("language"));

		$search = @$arv["search"];
		$tag = @$arv["tag"];
		$catalog = @$arv["catalog"];
		$ingore = @$arv["ingore"];
		$prev = @$arv["prev"];
		$next = @$arv["next"];
		$channel = @$arv["channel"];

		$limit = isset($arv["limit"]) ? intval($arv["limit"]) : 20;
		$page = isset($arv["page"]) ? intval($arv["page"]) : 1;
		$start = $page > 0 ? ($page - 1) * $limit : 0 * $limit;

		$this->db->where("language", $language);
		$this->db->select("{$this->table}.post_id as id, {$this->table}.post_image as image, {$this->table}.post_title as name, {$this->table}.post_url as url, {$this->table}.post_tag as tag, {$this->table}.created_date, {$this->table}.views, {$this->table}.channel");

		$this->db->limit($limit,$start);


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
		if(is_array($tag)){
			foreach ($tag as $key => $value) {
				$this->db->like("{$this->table}.post_tag", $value);
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
		$arv = [];
		foreach ($data as $key => $value) {
			$value->catalog = $this->db->select($this->postInCatalog.".post_id, ".$this->postInCatalog.".catalog_id, catalog.catalog_name as catalog_name, catalog.catalog_url as catalog_url")->join("catalog","catalog.catalog_id=".$this->postInCatalog.".catalog_id","left")->get_where($this->postInCatalog, ["post_id" => $value->id])->result();
			$value->image = isObject($value->image);
			$arv[] = $value;
		}
		return $arv;
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

	
}