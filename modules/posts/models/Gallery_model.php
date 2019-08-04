<?php
use \Sonata\Model;

class Gallery_model extends Model{
	
	private $table_gallery = "gallery";
	private $table_gallery_image = "gallery_image";

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
		if(!$data) return;
		$data->image = $this->db->get_where($this->table_gallery_image,["gallery_id" => $data->id])->result();
		return $data;
	}
}