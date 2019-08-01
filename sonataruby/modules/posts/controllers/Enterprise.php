<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise as CPEnterprise;
use \Sonata\Image;
class Enterprise extends CPEnterprise {

	
	public function index()
	{
		$this->view('welcome_message');
	}
	public function catalog($id=false){

		$data = $this->catalog_model->getData(false, $id);
		
		if($this->isPost()){
			$arv = [
				"catalog_name" => $this->input->post("catalog_name"),
				"catalog_url" => $this->input->post("catalog_url"),
				"catalog_content" => $this->input->post("catalog_content"),
				"language" => $this->config->item("language")
			];
		
			$id = $this->catalog_model->create($id, $arv);
			$this->go("/posts/enterprise/catalog");
		}

		$getList = $this->catalog_model->getList($this->config->item("language"), true);
		$this->view($this->get_views('catalog'),["data" => $data, "ListNode" => $getList]);
	}

	public function createcatalog(){
		$id = 0;
		if($this->isPost()){
			$arv = [
				"catalog_name" => ($this->input->post("catalog_name") ? $this->input->post("catalog_name") : "Catalog name"),
				"catalog_parent" => ($this->input->post("catalog_parent") ? $this->input->post("catalog_parent") : 0),
				"language" => $this->config->item("language")
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




	/*
	Posts Interface
	*/
	public function posts(){
		$data = $this->posts_model->getList();
		$catalog = $this->catalog_model->dropdown();
		$this->view($this->get_views('posts'),["catalog" => $catalog, "data" => $data]);
	}

	public function create($id=false){
		$data = $this->posts_model->getData(false, $id);
		if($this->isPost()){
			$image = new Image;
			$arv = [];
			$arv["post_title"] = $this->input->post("post_title");
			$arv["post_image"] = $image->saveImageUpload($this->input->post("post_image"), "image",@$data->post_image);
			$arv["post_content"] = $this->input->post("content");
			$arv["post_tag"] = $this->input->post("post_tag");
			$arv["language"] = $this->config->item("language");

			$this->posts_model->create($id, $arv, $this->input->post("catalog"));
			$this->go("posts/enterprise/posts");
		}

		$catalog_id = [];
		if(isset($data->catalog)){
			foreach ($data->catalog as $key => $value) {
				$catalog_id[] = $value->catalog_id;
			}
		}
		

		$catalog = $this->catalog_model->dropdown(false,"checkbox",$catalog_id);

		$this->view($this->get_views('posts-create'),["catalog" => $catalog, "data" => $data]);
	}


	/*
	Gallery
	*/


	public function gallery($id=false){
		if($this->isPost()){
			$arv = [];
			$arv["gallery_name"] = $this->input->post("gallery_name");
			$id = $this->posts_model->create_gallery($id, $arv);
			$this->toJson(["id" => $id]);
			exit();
		}
		$data = $this->posts_model->getListGallery();
		$this->view($this->get_views('gallery'),["data" => $data]);
	}

	public function gimage($gid=false){
		$data = $this->posts_model->getInfoGallery(false, $gid);
		$this->view($this->get_views('gallery-image'),["data" => $data]);
	}

	/*
	Video
	*/
	public function video(){
		$this->view($this->get_views('video'),[]);
	}
}
