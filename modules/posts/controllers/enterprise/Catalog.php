<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise as CPEnterprise;
use \Sonata\Image;
class Catalog extends CPEnterprise {

	public function __construct()
	{
	    parent::__construct();
	   
	}
	public function index()
	{
		return $this->catalog();
	}
	public function catalog($id=false){

		$data = $this->catalog_model->getData(false, $id);
		
		if($this->isPost()){
			$arv = [
				"catalog_name" => $this->input->post("catalog_name"),
				"catalog_url" => $this->input->post("catalog_url"),
				"catalog_content" => $this->input->post("catalog_content"),
				"language" => $this->config->item("language"),
				"channel" => ($this->input->post("channel") ? $this->input->post("channel") : ""),
			];
		
			$id = $this->catalog_model->create($id, $arv);
			$this->go("/posts/enterprise/catalog");
		}

		$query = [];
		if($this->input->get("channel")){
			$query["channel"] = $this->input->get("channel");
		}
		$getList = $this->catalog_model->getList($query,$this->config->item("language"), true);
		
		$this->view('catalog',["data" => $data, "ListNode" => $getList]);
	}

	public function createcatalog(){
		$id = 0;
		if($this->isPost()){
			$arv = [
				"catalog_name" => ($this->input->post("catalog_name") ? $this->input->post("catalog_name") : "Catalog name"),
				"catalog_parent" => ($this->input->post("catalog_parent") ? $this->input->post("catalog_parent") : 0),
				"language" => $this->config->item("language"),
				"channel" => ($this->input->post("channel") ? $this->input->post("channel") : config_item("default_channel")),
			];
		
			$id = $this->catalog_model->create(false, $arv);
			
		}
		$data = $this->catalog_model->getData(false, $id);
		$this->toJson($data);
	}

	public function catalogsorts(){
		$getData = $this->input->post("data");
		$this->catalog_model->sorts(json_decode($getData));
		return true;
	}

	public function catalogjson($id=0){
		$data = $this->catalog_model->getData(false, $id);
		$this->toJson($data);
	}

	public function catalogsavejson($id=0){
		$id = ($id > 0 ? $id : $this->input->post("catalog_id"));
		if($this->isPost()){
			$arv = [
				"catalog_name" => $this->input->post("catalog_name"),
				"catalog_url" => $this->input->post("catalog_url"),
				"catalog_parent" => ($this->input->post("catalog_parent") > 0 ? $this->input->post("catalog_parent") : 0),
				"catalog_content" => $this->input->post("catalog_content"),
				"language" => $this->config->item("language"),
				"channel" => ($this->input->post("channel") ? $this->input->post("channel") : config_item("default_channel")),
				
			];
		
			$id = $this->catalog_model->create($id, $arv);
			$data = $this->catalog_model->getData(false, $id);
			$this->toJson($data);
		}
		$data = $this->catalog_model->getData(false, $id);
			$this->toJson($data);

	}

	public function catalogdelete($id=0){
		$this->catalog_model->delete($id);
		$this->toJson(["status" => "success"]);
	}

	public function catalogstatus($id=0){
		
		if($this->isPost()){
			$value = $this->input->post("value") == 1 ? 0 : 1;
			$arv = [];
			if($this->input->post("field") == "status"){
				$arv["status"] = $value;
			}

			if($this->input->post("field") == "show_dashboard"){
				$arv["show_dashboard"] = $value;
			}

			if($this->input->post("field") == "show_menu"){
				$arv["show_menu"] = $value;
			}
			if($this->input->post("field") == "show_header"){
				$arv["show_header"] = $value;
			}
			$id = $this->catalog_model->create($id, $arv);
			
			$this->toJson(["status" => "success"]);

		}
		$this->toJson(["status" => "false"]);
	}
}