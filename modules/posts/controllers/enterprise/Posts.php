<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Posts extends Enterprise {

	public function __construct()
	{
	    parent::__construct();

	    
	}
	public function index()
	{
		return $this->posts();
	}

	/*
	Posts Interface
	*/
	public function posts(){
		$channel = ($this->input->get("channel") ? $this->input->get("channel") : config_item("default_channel"));
		$catalog = ($this->input->get("catalog") ? $this->input->get("catalog") : false);
		$search = ($this->input->get("search") ? $this->input->get("search") : false);
		
		$data = $this->posts_model->getList(["channel" => $channel, "pages" => true, "catalog" => $catalog,"search" => $search]);

		$pages = $this->posts_model->pages();
		
		$catalog = $this->catalog_model->dropdown(["channel" => $channel],false,"select",["selected" => $catalog]);
		

		$this->view('posts',["catalog" => $catalog, "data" => $data,"channel" => $channel, "pages" => $pages]);
	}

	public function create($id=false){
		$channel = ($this->input->get("channel") ? $this->input->get("channel") : config_item("default_channel"));
		$data = $this->posts_model->getData(false, $id);

		if($this->isPost()){
			$image = new Image;
			$arv = [];
			$arv["post_title"] = $this->input->post("post_title");
			$arv["post_image"] = $image->saveImageUpload($this->input->post("post_image"), "image",@$data->post_image);
			$arv["post_content"] = $this->clearContent($this->input->post("content"));
			$arv["post_tag"] = $this->input->post("post_tag");
			$arv["language"] = $this->config->item("language");
			$arv["channel"] = ($this->input->post("channel") ? $this->input->post("channel") : config_item("default_channel"));

			$this->posts_model->create($id, $arv, $this->input->post("catalog"));

			if($this->input->post("ref")){
				$this->go("posts/enterprise/posts?".getRef($this->input->post("ref")));
			}else{
				$this->go("posts/enterprise/posts?channel=".$this->input->post("channel"));
			}
			
		}

		$catalog_id = [];
		if(isset($data->catalog)){
			foreach ($data->catalog as $key => $value) {
				$catalog_id[] = $value->catalog_id;
			}
		}
		

		$catalog = $this->catalog_model->dropdown(["channel" => $channel],false,"checkbox",$catalog_id);
		$options = "";
		if(method_exists($this->posts_model->hookClass, "editControl")) $options = $this->posts_model->hookClass->editControl($data);
		$this->view('posts-create',["catalog" => $catalog, "data" => $data, "options" => $options]);
	}

	public function deletepost($id=false){
		$this->posts_model->delete($id);
		$channel = ($this->input->get("channel") ? $this->input->get("channel") : config_item("default_channel"));
		if($this->input->get("ref")){
			$this->go("posts/enterprise/posts?".getRef($this->input->get("ref")));
		}else{
			$this->go("/posts/enterprise/posts?channel=".$channel);
		}

		
	}


	public function sample(){
		$this->posts_model->example(25, "posts");
		$this->go("/posts/enterprise/posts?channel=".$channel);
	}
}