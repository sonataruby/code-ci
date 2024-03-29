<?php
use \Sonata\Model;

class Pages_model extends Model{
	private $table = "pages";

	public function create($id=false, $arv=[]){
		$arv["page_url"] = $this->makeURL($arv["page_name"], @$arv["page_url"], $id);
		if($id){
			$this->db->update($this->table, $arv,["page_id" => $id, "store" => $this->store_id]);
		}else{
			$arv["language"] = $this->config->item("language");
			$arv["store"] = $this->store_id;
			
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
		if($this->store_id) $this->db->where("store", $this->store_id);
		$this->db->select("page_id as id, page_name as name, page_image as image, page_description as description, page_keyword as keyword, page_layout as layout, page_url as url, page_icoin as icoin, page_tag as tag, page_content as content, show_menu, status, parent_id");
		$data = $this->db->get($this->table)->row();
		if(!$data) return;
		
		$data->image = isObject($data->image);
		return $data;
	}

	public function getList($arv=[],$language=false){
		
		$language = ($language ? $language : $this->config->item("language"));
		
		$this->db->where("language", $language);
		if($this->store_id) $this->db->where("store", $this->store_id);

		if(isset($arv["in"])){
			$this->db->where_in("page_id", $arv["in"]);
		}
		if(isset($arv["parent_id"])){
			$this->db->where("parent_id", $arv["parent_id"]);
		}else{
			$this->db->where("parent_id", 0);
		}

		if(isset($arv["show_menu"])){
			$this->db->where("show_menu", $arv["show_menu"]);
		}

		$this->db->select("page_id as id, page_name as name, page_image as image, page_description as description, page_keyword as keyword, page_layout as layout, page_url as url, page_icoin as icoin, page_tag as tag, show_menu, status, parent_id");

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


	public function getDropdown($arv=[]){
		$data = $this->getList($arv);
		$arv = '<ul>';
		foreach ($data as $key => $value) {
			$arv .= '<li><a href="'.page_url($value->url).'" title="'.$value->name.'">'.$value->name.'</a></li>';
		}
		$arv .= '<ul>';
		return $arv;
	}


	public function delete($id=false){
		
		
		$this->db->where("language", $this->config->item("language"));

		if($this->store_id) $this->db->where("store", $this->store_id);
		if($id) $this->db->where("page_id", $id);
		$this->db->delete($this->table);
	}
}