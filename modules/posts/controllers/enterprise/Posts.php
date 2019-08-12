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
		$data = $this->posts_model->getList();
		$catalog = $this->catalog_model->dropdown();
		$this->view('posts',["catalog" => $catalog, "data" => $data]);
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

		$this->view('posts-create',["catalog" => $catalog, "data" => $data]);
	}

}