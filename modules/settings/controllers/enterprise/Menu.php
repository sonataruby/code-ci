<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Menu extends Enterprise {
	public function index(){
		$this->manager();
	}


	public function manager(){
		$parent = ($this->input->get("parent") ? intval($this->input->get("parent")) : 0);
		$this->savejson();
		$item = $this->menu_model->getList($parent);
		$id = $this->input->get("id");
		$data = $this->menu_model->data($id);
		$this->view("menu",["item" => $item, "data" => $data, "menutagSelect" => $this->menutag(true)]);
	}

	public function savejson($id=false){
		if($this->isPost()){

			$arv = [
				"menu_name" => $this->input->post("name"),
				"menu_link" => $this->input->post("url"),
				"menu_icon" => $this->input->post("icon"),
				"language" => $this->config->item("language")
			];
			if(!$id){
				$arv["parent_id"] = ($this->input->post("parent_id") ? $this->input->post("parent_id") : 0);
			}
			$id = ($this->input->post("id") ? intval($this->input->post("id")) : $id);
			$data = $this->menu_model->save($arv, $id);
			return $this->tojson(["id" => $data]);
			exit();
		}
	}

	public function menutag($return=false){
		$data = $this->pages_model->getList();
		$arv = [];
		$arv["home"] = "Home";
		$arv["allcatalog"] = "All Catalog";
		foreach ($data as $key => $value) {
			$arv["page_".$value->id] = $value->name;
		}

		$data = $this->catalog_model->getList();
		foreach ($data as $key => $value) {
			$arv["catalog_".$value->id] = $value->name;
		}

		return $this->tojson($arv, $return);
		
	}


	public function sorts(){
		$getData = $this->input->post("data");
		$this->menu_model->sorts(json_decode($getData));
		return true;
	}


	public function jsoninfo($id){
		$data = $this->menu_model->data($id);
		$this->tojson($data);
	}

	public function createjson(){
		if($this->isPost()){

			$arv = [
				"menu_name" => $this->input->post("name"),
				"menu_link" => "#",
				"parent_id" => ($this->input->post("parent_id") ? $this->input->post("parent_id") : 0),
				"language" => $this->config->item("language")
			];
			$data = $this->menu_model->save($arv, false);
			$this->jsoninfo($data);
			exit();
		}
	}

	public function delete($id){
		$this->menu_model->delete($id);
		$this->tojson(["status" => "success"]);
	}
}