<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Configs extends Enterprise {

	public function __construct()
	{
	    parent::__construct();
	   
	}

	public function index(){
		$this->manager();
	}

	public function manager(){
		$image = new Image;
		if($this->isPost()){
			$config = $this->input->post("config");
			$config["navbar_icon"] = $image->saveImageUpload($config["navbar_icon"], "image",[],"navbar");
			$config["logo"] = $image->saveImageUpload($config["logo"], "image",[],"logo");
			$config["banner"] = $image->saveImageUpload($config["banner"], "image",[],"banner");
			$config["icon"] = $image->saveImageUpload($config["icon"], "image",[],"favicon",["32x32","16x16","64x64","150x150","192x192","512x512"]);
			$this->settings_model->save($config);
			$this->go("settings/enterprise/configs");
		}
		$data = $this->settings_model->getData();
		$this->view('config',["data" => $data]);
	}

	public function api(){
		$data = [];
		$this->view('api',["data" => $data]);
	}
}