<?php
use \Sonata\Model;

class Menu_model extends Model{
	public $table = "menu";
	public function save($arv=[],$id=false){
		if(!$arv) return;
		if($id){
			$this->db->update($this->table, $arv, ["menu_id" => $id]);
		}else{
			if($this->store_id) $arv["store"] = $this->store_id;
			$this->db->insert($this->table, $arv);
			$id = $this->db->insert_id();
		}
		return $id;

	}

	public function data($id){
		$this->db->select("menu_id as id, parent_id, menu_name as name, menu_icon as icon, menu_link as url, menu_sort as sorts");
		$this->db->where("menu_id", $id);
		$data = $this->db->get($this->table)->row();
		return $data;
	}

	public function getList($parent=0,$language=false){
		
		$data = $this->renderItemChild($parent, false, false);
		
		return $data;
	}


	public function getDropdown($parent=0,$language=false){
		
		$data = $this->renderItemDropdown($parent, false, false);
		
		return $data;
	}

	public function sorts($data, $parent=0){
		$i = 0;
		foreach ($data as $key => $value) {
			if(isset($value->children)){
				$this->sorts($value->children, $value->id);
			}
			$this->db->update($this->table,["menu_sort" => $i + 1, "parent_id" => $parent], ["menu_id" => $value->id]);
			$i++;
			
		}
	}
	

	private function renderItemChild($parent_id, $language=false, $return=true){
		$language = !$language ? config_item("language") : $language;
		$this->db->where("parent_id",$parent_id);
		$this->db->where("language", $language);
		if($this->store_id) $this->db->where("store",$this->store_id);
		$this->db->order_by("menu_sort","ASC");
		$this->db->select("menu_id as id, parent_id, menu_name as name, menu_icon as icon, menu_link as url, menu_sort as sorts");

		$data = $this->db->get($this->table)->result();
		if($return) return $data;
		return $this->renderItemOLSorts($data);
	}

	private function renderItemOLSorts($obj){
		$arv = "";
		$arv .= '<ol class="dd-list">';
		foreach ($obj as $key => $value) {
			$check = $this->db->get_where($this->table, ["parent_id" => $value->id])->num_rows();
			$arv .= '<li class="dd-item" data-id="'.$value->id.'"><div class="dd-handle">Drag</div><div class="dd-content"><a href="/settings/enterprise/menu/manager?parent='.$value->id.'">'.$value->name.'</a><div class="dd-panel"><a onClick="getCreate('.$value->id.')"><i class="fa fa-plus"></i></a> <a onClick="getEdit('.$value->id.')"><i class="fa fa-edit"></i></a> <a onClick="getDelete('.$value->id.')"><i class="fa fa-trash"></i></a></div></div>';
			if($check > 0){
				$arv .= $this->renderItemChild($value->id,false, false);
			}
			$arv .= '</li>';
		}
		$arv .= '</ol>';
		return $arv;
	}



	private function makeData($arv=[], $language=false){
		$language = !$language ? config_item("language") : $language;
		$parent_id = isset($arv["parent_id"]) ? intval($arv["parent_id"]) : 0;
		$this->db->order_by("menu_sort","ASC");
		$this->db->where("parent_id",$parent_id);
		$this->db->where("language", $language);
		if($this->store_id) $this->db->where("store",$this->store_id);
		$this->db->select("menu_id as id, parent_id, menu_name as name, menu_icon as icon, menu_link as url, menu_sort as sorts");

		$data = $this->db->get($this->table)->result();
		return $data;
	}

	private function renderItemDropdown($parent_id, $language=false, $return=true){
		

		$data = $this->makeData(["parent_id" => $parent_id], $language);
		$arv = '<ul class="navbar-nav mr-auto">';
		foreach ($data as $key => $value) {
			
			$check = $this->db->get_where($this->table, ["parent_id" => $value->id])->num_rows();
			$icon = ($value->icon ? '<i class="'.$value->icon.' fa-icon"></i> ' : "");
			$sup = explode(',', $value->url);
			if($check > 0 || count($sup) > 1 || $value->url == "allcatalog"){
				$classLI = "nav-item dropdown";
				$classA = ["class" => "nav-link dropdown-toggle","role" => "button", "data-toggle"=> "dropdown", "aria-haspopup" => "true", "aria-expanded" => "false"];
			}else{
				$classLI = "nav-item";
				$classA = ["class" => 'nav-link'];
			}


			$arv .= '<li class="'.$classLI.'"><a '._attributes_to_string($classA).' href="'.site_url(($value->url !== "home" ? $value->url : "/")).'">'.$icon.$value->name.'</a>';
			if($check > 0 || count($sup) > 1){
				$arv .= $this->renderItemULSorts($value->id,  $sup);
			}
			if($value->url == "allcatalog"){
				$arv .= $this->getAllCatalog();
			}
			$arv .= '</li>';
		}
		$arv .= '</ul>';
		return $arv;
	}

	private function renderItemULSorts($parent_id, $obj = []){
		//if(count($obj) < 2) return;
		$data = $this->makeData(["parent_id" => $parent_id]);
		$arv = '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
		foreach ($data as $key => $value) {
			$check = $this->db->get_where($this->table, ["parent_id" => $value->id])->num_rows();
			$sup = explode(',', $value->url);

			$arv .= '<li class="dropdown-item"><a href="'.site_url(($value->url !== "home" ? $value->url : "/")).'">'.$value->name.'</a>';
			if($check > 0 || count($sup) > 1){
				$arv .= $this->renderItemULSorts($value->id, $sup);
			}
			$arv .= '</li>';

			//$arv .= $this->link_item($sup);
		}
		if($obj){
			$arv .= $this->link_item($obj);
		}
		$arv .= '</ul>';
		return $arv;
	}

	private function link_item($sup=[]){
		
		$getPage = []; $getCatalog = [];

		foreach ($sup as $keySub => $valueSub) {
			if(strpos($valueSub, "page_") !== false){
				$getPage[] = str_replace('page_', '', $valueSub);
				
			}else if(strpos($valueSub, "catalog_") !== false){
				$getCatalog[] = str_replace('catalog_', '', $valueSub);
				
			}
		}

		
		$arv = '';
		if($getPage){
			$pageInfo = $this->pages_model->getList(["in" => implode(', ', $getPage)]);
			foreach ($pageInfo as $keyPage => $valuePage) {
				$icon = ($valuePage->icoin ? '<i class="'.$valuePage->icoin.' fasub-icon"></i> ' : "");
				$arv .= '<li class="dropdown-item"><a href="'.page_url($valuePage->url).'">'.$icon.$valuePage->name.'</a></li>';
			}
		}
		if($getCatalog){
			$catalogInfo = $this->catalog_model->getList(["in" => implode(', ', $getCatalog)]);
			foreach ($catalogInfo as $keyPage => $valuePage) {
				$arv .= '<li class="dropdown-item"><a href="'.catalog_url($valuePage->url).'">'.$valuePage->name.'</a></li>';
			}
		}
		return $arv;
	}

	public function getAllCatalog(){
		$arv = '';
		$arv = '<ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
		$catalogInfo = $this->catalog_model->getList();
		foreach ($catalogInfo as $keyPage => $valuePage) {
			$arv .= '<li class="dropdown-item"><a href="'.catalog_url($valuePage->url).'">'.$valuePage->name.'</a></li>';
		}
		$arv .= '</ul>';
		return $arv;
	}





	public function delete($id){
		$count = $this->db->get_where($this->table,['parent_id'=>$id])->result();
		if(count($count) > 0){
			foreach ($count as $key => $value) {
				$this->delete($value->menu_id);
			}
			
		}
		$this->db->delete($this->table,["parent_id" => $id]);
		$this->db->delete($this->table,["menu_id" => $id]);
		

		return true;
	}
}