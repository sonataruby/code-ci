<?php
use \Sonata\Model;

class Layout_model extends Model{
	private $table = "pages_layout";

	public function create($id=false, $arv=[]){
		$arv["layout_url"] = $this->makeURL($arv["layout_name"], $arv["layout_url"], $id);
		if($id){
			$this->db->update($this->table, $arv,["layout_id" => $id]);
		}else{
			$this->db->insert($this->table, $arv);
			$id = $this->db->insert_id();
		}
		$this->cacheLayout($id);
		return $id;
	}
	public function updatecontent($id=false, $arv=[]){
		$this->db->update($this->table, $arv,["layout_id" => $id]);
		return $id;
	}


	private function cacheLayout($id){
		$this->load->helper('file');
		$settemplate = CMS_THEMEPATH . TEMPLATE_ACTIVE . DIRECTORY_SEPARATOR . "layout" . DIRECTORY_SEPARATOR;
		if(!is_dir($settemplate)) mkdir($settemplate, 0775, true);
		$data = $this->getData(false, $id);
		$settemplate .= $data->url.".php";
		write_file($settemplate, $data->content,'wb');
	}



	public function getData($url="", $id=false, $language=false){
		if(!trim($url) && !$id) return;
		if($url){
			$this->db->where("layout_url", $url);
		}
		if($id){
			$this->db->where("layout_id", $id);
		}
		$language = ($language ? $language : $this->config->item("language"));
		$this->db->where("language", $language);

		$this->db->select("layout_id as id, layout_name as name, layout_image as image, layout_description as description, layout_keyword as keyword, layout_url as url, layout_content as content");
		$data = $this->db->get($this->table)->row();

		//$data->content = $this->makeContent($data->content);
		if(!$data) return;

		if (is_object(json_decode($data->image))){
			$data->image = json_decode($data->image);
		}else{
			$data->image = [$data->image];
		}
		return $data;
	}

	private function makeContent($text){
		if(defined("BASE_ENTERPRISE")){
			$search = ['{content}'];
			$replace = ['<div class="plugins content"></div>'];
			return str_replace($search, $replace, $text);
		}
		return $text;
	}


	public function getList($language=false){
		$language = ($language ? $language : $this->config->item("language"));
		$this->db->where("language", $language);
		$this->db->select("layout_id as id, layout_name as name, layout_image as image, layout_description as description, layout_keyword as keyword, layout_url as url, layout_content as content");
		return $this->db->get($this->table)->result();
	}


	private function makeURL($name, $url, $id=false){
		if(trim($url)){
			$name = $url;
		}
		if($id > 0){
			$this->db->where("layout_id !=",$id);
		}
		$url = url_title(convert_accented_characters($name),"_",true);
		$this->db->where("layout_url", $url);
		$count = $this->db->get($this->table)->num_rows();

		return $url.($count > 0 ? "_".$count : "");
	}


	public function windget_save($arv=[], $id=false){
		if($id){
			$this->db->update("widgets", $arv,["winget_id" => $id]);
		}else{
			$language = (@$arv["language"] ? $arv["language"] : $this->config->item("language"));
			$arv["language"] = $language;
			$this->db->insert("widgets", $arv);
			$id = $this->db->insert_id();
		}
		return $id;
	}

	public function windget_result($language=false, $filter = ""){
		$language = ($language ? $language : $this->config->item("language"));
		$this->db->where("language", $language);

		if($filter){
			$this->db->like("winget_display",$filter);
		}

		$this->db->order_by("winget_sort","ASC");
		return $this->db->get("widgets")->result();
	}


	public function windget_row($id=false){
		
		$this->db->where("winget_id", $id);
		return $this->db->get("widgets")->row();
	}
}