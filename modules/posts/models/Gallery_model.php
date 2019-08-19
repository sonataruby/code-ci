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
		$this->db->select("gallery_id as id, gallery_name as name, gallery_url as url, created_date, tags");
		$data = $this->db->get($this->table_gallery)->result();
		$arv = [];
		foreach ($data as $key => $value) {
			$value->image = $this->getImageList($value->id,["limit" => 2]);
			$arv[] = $value;
		}
		return $arv;
	}


	public function getRemoveGallery($gid){
		$this->load->helper(['directory','file']);
		$this->db->delete($this->table_gallery,["gallery_id" => $gid]);
		$this->db->delete($this->table_gallery_image,["gallery_id" => $gid]);
		delete_files(UPLOAD_PATH . "image/gallery/{$gid}");
	}

	public function getInfoGallery($url=false, $id=false, $arv=[]){
		$this->db->select("gallery_id as id, gallery_name as name, gallery_url as url, created_date, tags");
		if($url){
			$this->db->where("gallery_url", $url);
		}
		if($id){
			$this->db->where("gallery_id", $id);
		}
		if(isset($arv["tags"]) && $arv["tags"]){
			$this->db->like("tags", $arv["tags"]);
		}
		$data = $this->db->get($this->table_gallery)->row();
		if(!$data) return;
		$data->image = $this->getImageList($data->id, $arv);
		return $data;
	}

	public function getImageList($gid=false, $arv=[]){
		if($gid){
			$this->db->where("gallery_id", $gid);
		}
		$limit = (@$arv["limit"] ? intval($arv["limit"]) : 20);
		$this->db->limit($limit);
		$this->db->order_by("image_sorts","ASC");
		return $this->db->get($this->table_gallery_image)->result();
	}

	public function syncImage($arv=[]){
		$check = $this->db->get_where($this->table_gallery_image,["image_hash" => $arv["image_hash"]])->num_rows();
		if($check == 0){
			$this->db->insert($this->table_gallery_image, $arv);
		}
	}

	public function remove($image_hash){
		$this->db->delete($this->table_gallery_image,["image_hash" => $image_hash]);
	}

	public function sorts($number, $image_id){
		$this->db->update($this->table_gallery_image, ["image_sorts" => $number],["image_id" => $image_id]);
	}
}