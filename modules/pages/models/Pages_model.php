<?php
use \Sonata\Model;

class Pages_model extends Model{
	private $table = "pages";

	public function create($id=false, $arv=[]){
		$arv["page_url"] = $this->makeURL($arv["page_name"], $arv["page_url"], $id);
		if($id){
			$this->db->update($this->table, $arv,["page_id" => $id]);
		}else{
			$this->db->insert($this->table, $arv);
			$id = $this->db->insert_id();
		}
		return $id;
	}



	public function getData($url="", $id=false, $language=false){
		if(!$url && !$id) return;
		if($url){
			$this->db->where("page_url", $url);
		}
		if($id){
			$this->db->where("page_id", $id);
		}
		$language = ($language ? $language : $this->config->item("language"));
		$this->db->where("language", $language);

		$this->db->select("page_id as id, page_name as name, page_image as image, page_description as description, page_keyword as keyword, page_layout as layout, page_url as url, page_icoin as icoin, page_tag as tag, page_content as content, show_menu, show_header, status");
		$data = $this->db->get($this->table)->row();
		if(!$data) return;
		
		if (is_object(json_decode($data->image))){
			$data->image = json_decode($data->image);
		}else{
			$data->image = [$data->image];
		}
		return $data;
	}

	public function getList($language=false){
		$language = ($language ? $language : $this->config->item("language"));
		$this->db->where("language", $language);
		$this->db->select("page_id as id, page_name as name, page_image as image, page_description as description, page_keyword as keyword, page_layout as layout, page_url as url, page_icoin as icoin, page_tag as tag, show_menu, show_header, status");
		return $this->db->get($this->table)->result();
	}

	private function makeURL($name, $url, $id=false){
		if(trim($url)){
			$name = $url;
		}
		if($id > 0){
			$this->db->where("page_id !=",$id);
		}
		$url = url_title(convert_accented_characters($name),"-",true);
		$this->db->where("page_url", $url);
		$count = $this->db->get($this->table)->num_rows();

		return $url.($count > 0 ? "-".$count : "");
	}

}