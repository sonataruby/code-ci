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



	public function channels(){
		$data = [];
		$dataRead = $this->settings_model->getData();

		$channel = (array)isObject($dataRead->channel);

		//$channel = (strlen(@$channel[0]) < 2 ? [] : $channel);
		
		if($this->isPost()){
			$config = $this->input->post("channel");
			$edit = $this->input->post("edit");

			
			$data = [];

			if($edit){
				$data[$edit] = ["name" => $config["name"], "url" => $edit, "layout" => $config["layout"]];
			}else{
				$data[$config["url"]] = ["name" => $config["name"], "url" => $config["url"], "layout" => $config["layout"]];
			}
			

			$data = array_merge($channel, $data);
			$json = $this->tojson($data, true);
			$this->settings_model->save(["channel" => $json]);
			$this->go("settings/enterprise/configs/channels");
		}
		$edit = $this->input->get("edit");
		$delete = $this->input->get("delete");

		/*
		Delete Item
		*/
		if($delete && isset($channel[$delete])){
			unset($channel[$delete]);
			$json = $this->tojson($channel, true);
			$this->settings_model->save(["channel" => $json]);
			$this->go("settings/enterprise/configs/channels");
		}

		$editdata = @$channel[$edit];
		$this->view('channel',["data" => $channel, "edit" => $editdata]);
	}
}