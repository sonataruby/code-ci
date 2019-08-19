<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Tags extends Enterprise {

	public function __construct()
	{
	    parent::__construct();
	   
	}
	public function index()
	{
		return $this->manager();
	}

	/*
	Gallery
	*/
	public function manager(){
		if($this->isPost()){
			$tag = $this->input->post("tags");
			$this->settings_model->save(["tags" => $tag]);
			$this->go("/posts/enterprise/tags");
		}
		$dataRead = $this->settings_model->getData();
		$data = @$dataRead->tags;
		$this->view('tags',["data" => $data]);
	}
}