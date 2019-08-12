<?php
use \Sonata\Model;

class Catalog_model extends Model{
	private $table = "catalog";

	public function create($id=false, $arv=[]){

		if(isset($arv["catalog_name"])){
			$arv["catalog_url"] = $this->makeURL($arv["catalog_name"], @$arv["catalog_url"], $id);
		}
		
		if($id){
			$this->db->update($this->table, $arv,["catalog_id" => $id]);
		}else{
			$this->db->insert($this->table, $arv);
			$id = $this->db->insert_id();
		}
		return $id;
	}



	public function getData($url="", $id=false, $loadpost=false, $loadList=false){
		if(!$url && !$id) return;
		if($url){
			$this->db->where("catalog_url", $url);
		}
		if($id){
			$this->db->where("catalog_id", $id);
		}

		$data = $this->db->get($this->table)->row();
		if($loadpost && $data){
			$data->posts = $this->posts_model->getList(["catalog" => $data->catalog_id]);
		}
		if($loadList && $data){
			$data->listCatalog = $this->dropdown(false, "ul");
		}
		return $data;
	}

	public function getList($arv=[], $language=false, $relaytion=false){
		$language = ($language ? $language : $this->config->item("language"));
		$this->db->where("language", $language);
		$this->db->order_by("catalog_sort","ASC");
		$this->db->select("catalog_id as id, catalog_name as name, catalog_url as url, catalog_parent as parent, show_menu, show_header, show_dashboard, status");
		
		if(isset($arv["in"])){
			$this->db->where_in("catalog_id", $arv["in"]);
		}

		if($relaytion == false){
			return $this->db->get($this->table)->result();
		}else{
			$this->db->where("catalog_parent",0);
			$data = $this->db->get($this->table)->result();
			if(!$data) return;
			$arv = [];
			foreach ($data as $key => $value) {
				$count = $this->db->get($this->table,["catalog_parent" => $value->id])->num_rows();
				if($count > 0){
					$value->item = $this->mutile_res($value->id);
				}
				$arv[] = $value;
			}
			return $arv;
		}
		
	}

	private function mutile_res($catalog_parent){
		$arv = [];
		$this->db->order_by("catalog_sort","ASC");
		$this->db->select("catalog_id as id, catalog_name as name, catalog_url as url, catalog_parent as parent, show_menu, show_header, show_dashboard, status");
		$this->db->where("catalog_parent",$catalog_parent);
		$data = $this->db->get($this->table)->result();
		foreach ($data as $key => $value) {
			$count = $this->db->get($this->table,["catalog_parent" => $value->id])->num_rows();
			if($count > 0){
				$value->item = $this->mutile_res($value->id);
			}
			$arv[] = $value;
		}
		return $arv;
	}

	public function dropdown($language=false, $tag="select", $attr=[]){
		$dataList = $this->getList([],$language, true);
		if($tag == "select"){
			$data = $this->dropdown_item($dataList);
		}else if($tag == "ul"){
			$data = $this->dropdown_item_ul($dataList, false, array_merge($attr,["class" => "catalog-box list-group list-group-flush", "icon" => "fa fa-angle-double-right", "icon_pick" => "fa fa-chevron-right"]));
		}else if($tag == "checkbox"){
			$data = $this->dropdown_item_checkbox($dataList, $attr);
		}
		return $data;
	}

	private function dropdown_item($arv=[], $prefix=false, $attr=[]){
		$html = !$prefix ? '<select class="form-control custom-select" '._stringify_attributes($attr).'>' : "";
		foreach ($arv as $key => $value) {
			
			
			$html .= '<option value="'.$value->id.'">'.(!$prefix ? "" : "|".$prefix).$value->name.'</option>';
			if(isset($value->item)){
				$html .= $this->dropdown_item($value->item, $prefix." - ");
			}
		}
		$html .= !$prefix ? '</select>' : "";
		return $html;
	}


	private function dropdown_item_ul($arv=[], $prefix=false, $attr=["class" => "catalog-box list-group list-group-flush"]){
		if(!$arv) return;

		$icon = isset($attr["icon"]) ? '<i class="'.$attr["icon"].' icon-row"></i> ' : "";
		$icon_pick = isset($attr["icon_pick"]) ? ' <i class="'.$attr["icon_pick"].' icon-pick"></i>' : "";

		if($icon) unset($attr["icon"]);
		if($icon_pick) unset($attr["icon_pick"]);

		$html = '<ul '._stringify_attributes($attr).'>';
		foreach ($arv as $key => $value) {
			
			
			$html .= '<li class="list-group-item"><a href="'.site_url('catalog/'.$value->url.'.html').'" title="'.$value->name.'">'.$icon.$value->name.$icon_pick.'</a>';
			if(isset($value->item)){
				$html .= $this->dropdown_item_ul($value->item, $prefix." - ", ["class" => "sub-catalog"]);
			}
			$html .= '</li>';
		}
		$html .= '</ul>';
		return $html;
	}

	private function dropdown_item_checkbox($arv=[], $attr=[]){
		$html = '<ul class="list-group list-group-flush list-group-checkbox">';
		foreach ($arv as $key => $value) {
			
			
			$html .= '<li class="list-group-item"><div class="form-check">
  <input type="checkbox" id="catalogCheck'.$value->id.'" value="'.$value->id.'" name="catalog[]" '.(in_array($value->id, $attr) ? "checked" : "").'>
  <label class="form-check-label" for="catalogCheck'.$value->id.'">'.$value->name.'</label></div>';
			if(isset($value->item)){
				$html .= $this->dropdown_item_checkbox($value->item, $attr);
			}
			$html .= '</li>';
		}
		$html .= '</ul>';
		return $html;
	}
	


	private function makeURL($name, $url, $id=false){
		if(trim($url)){
			$name = $url;
		}
		if($id > 0){
			$this->db->where("catalog_id !=",$id);
		}
		$url = url_title(convert_accented_characters($name),"-",true);
		$this->db->where("catalog_id", $url);
		$count = $this->db->get($this->table)->num_rows();

		return $url.($count > 0 ? "-".$count : "");
	}


	public function sorts($data, $parent=0){
		$i = 0;
		foreach ($data as $key => $value) {
			if(isset($value->children)){
				$this->sorts($value->children, $value->id);
			}
			$this->db->update($this->table,["catalog_sort" => $i + 1, "catalog_parent" => $parent], ["catalog_id" => $value->id]);
			$i++;
			
		}
	}

	public function delete($id){
		$count = $this->db->get_where($this->table,['catalog_parent'=>$id])->result();
		if(count($count) > 0){
			foreach ($count as $key => $value) {
				$this->delete($value->catalog_id);
			}
			
		}
		$this->db->delete($this->table,["catalog_parent" => $id]);
		$this->db->delete($this->table,["catalog_id" => $id]);
		

		return true;
	}

}