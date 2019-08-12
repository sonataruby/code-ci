<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Gallery extends Enterprise {

	public function __construct()
	{
	    parent::__construct();
	   
	}
	public function index()
	{
		return $this->gallery();
	}

	/*
	Gallery
	*/


	public function gallery($id=false){
		
		$data = $this->gallery_model->getListGallery();
		$this->view($this->get_views('gallery'),["data" => $data]);
	}


	public function create($id=false){
		if($this->isPost()){
			$arv = [];
			$arv["gallery_name"] = $this->input->post("gallery_name");
			$id = $this->gallery_model->create_gallery($id, $arv);
			$this->toJson(["id" => $id]);
			exit();
		}
	}
	public function gimage($gid=false){
		$data = $this->gallery_model->getInfoGallery(false, $gid);
		$this->view('gallery-image',["data" => $data]);
	}

}