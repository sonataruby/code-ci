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
			$this->db->update($this->table, $arv,["post_id" => $id]);
		}else{
			$this->db->insert($this->table, $arv);
			$id = $this->db->insert_id();
		}
		$this->posts_to_catalog($id, $catalog);
		return $id;
	}

	private function posts_to_catalog($post_id, $catalog=[]){

		$this->db->delete($this->postInCatalog,["post_id" => $post_id]);
		foreach ($catalog as $key => $value) {
			$this->db->insert($this->postInCatalog, ["catalog_id" => $value, "post_id" => $post_id]);
		}

	}


	public function getData($url="", $id=false){
		if(!$url && !$id) return;
		if($url){
			$this->db->where("post_url", $url);
		}
		if($id){
			$this->db->where("post_id", $id);
		}
		$this->db->select("post_id as id, post_title as name, post_url as url, post_tag as tag, post_content as content, post_image as image, created_date, views");
		$data = $this->db->get($this->table)->row();
		if (is_object(json_decode($data->image))){
			$data->image = json_decode($data->image);
		}else{
			$data->image = [$data->image];
		}
		$data->catalog = $this->db->select($this->postInCatalog.".post_id, ".$this->postInCatalog.".catalog_id, catalog.catalog_name as catalog_name, catalog.catalog_url as catalog_url")->join("catalog","catalog.catalog_id=".$this->postInCatalog.".catalog_id","left")->get_where($this->postInCatalog, ["post_id" => $data->id])->result();


		return $data;
	}

	public function getList($language=false){
		$language = ($language ? $language : $this->config->item("language"));
		$this->db->where("language", $language);
		$this->db->select("post_id as id, post_image as image, post_title as name, post_url as url, post_tag as tag, created_date, views");
		$data = $this->db->get($this->table)->result();
		$arv = [];
		foreach ($data as $key => $value) {
			$value->catalog = $this->db->select($this->postInCatalog.".post_id, ".$this->postInCatalog.".catalog_id, catalog.catalog_name as catalog_name, catalog.catalog_url as catalog_url")->join("catalog","catalog.catalog_id=".$this->postInCatalog.".catalog_id","left")->get_where($this->postInCatalog, ["post_id" => $value->id])->result();
			$value->image = $value->image;
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

	private function makeURLGallery($name, $url, $id=false){
		if(trim($url)){
			$name = $url;
		}
		if($id > 0){
			$this->db->where("gallery_id !=",$id);
		}
		$url = url_title(convert_accented_characters($name),"-",true);
		$this->db->where("gallery_url", $url);
		$count = $this->db->get($this->table_gallery)->num_rows();

		return $url.($count > 0 ? "-".$count : "");
	}



	public function create_gallery($id, $arv=[]){
		$arv["gallery_url"] = $this->makeURLGallery($arv["gallery_name"], @$arv["gallery_url"], $id);
		if($id){
			$this->db->update($this->table_gallery, $arv,["gallery_id" => $id]);
		}else{
			$arv["created_date"] = date("Y-m-d h:i:s");
			$this->db->insert($this->table_gallery, $arv);
			$id = $this->db->insert_id();
		}
		
		return $id;
	}

	public function getListGallery(){
		$this->db->select("gallery_id as id, gallery_name as name, gallery_url as url, created_date");
		$data = $this->db->get($this->table_gallery)->result();
		$arv = [];
		foreach ($data as $key => $value) {
			$value->image = $this->db->limit(5)->get_where($this->table_gallery_image,["gallery_id" => $value->id])->result();
			$arv[] = $value;
		}
		return $arv;
	}

	public function getInfoGallery($url=false, $id=false){
		$this->db->select("gallery_id as id, gallery_name as name, gallery_url as url, created_date");
		if($url){
			$this->db->where("gallery_url", $url);
		}
		if($id){
			$this->db->where("gallery_id", $id);
		}
		$data = $this->db->get($this->table_gallery)->row();
		$data->image = $this->db->get_where($this->table_gallery_image,["gallery_id" => $data->id])->result();
		return $data;
	}
}