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

		$channel = isObject(@$dataRead->channel);
		
		$channel = (empty($channel) ? [] : (array)$channel);
		
		if($this->isPost()){
			$config = $this->input->post("channel");
			$edit = $this->input->post("edit");

			
			$data = [];

			if($edit){
				$data[$edit] = ["name" => $config["name"], "url" => $edit, "layout" => $config["layout"], "image_size" => $config["image_size"], "options" => $config["options"]];
			}else{
				$data[$config["url"]] = ["name" => $config["name"], "url" => $config["url"], "layout" => $config["layout"], "image_size" => $config["image_size"], "options" => $config["options"]];
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


	/*
	urlredirect
	*/

	public function Urlredirect(){
		$data = [];
		$dataRead = $this->settings_model->getData();

		$redirect = isObject(@$dataRead->redirect);
		
		$redirect = (empty($redirect) ? [] : (array)$redirect);



		if($this->isPost()){
			$config = $this->input->post("redirect");
			$edit = $this->input->post("post");

			
			$data = [];

			
			$data[$config["old_url"]] = $config["new_url"];
			$data = array_merge($redirect, $data);
			$json = $this->tojson($data, true);
			
			$this->settings_model->save(["redirect" => $json]);
			$this->go("settings/enterprise/configs/urlredirect");
		}
		$edit = $this->input->get("edit");
		$delete = $this->input->get("delete");

		/*
		Delete Item
		*/
		if($delete && isset($redirect[$delete])){
			unset($redirect[$delete]);
			$json = $this->tojson($redirect, true);
			$this->settings_model->save(["redirect" => $json]);
			$this->go("settings/enterprise/configs/urlredirect");
		}
		
		$editredirect = ["old_url" => $edit,"new_url" => @$redirect[$edit]];

		$this->view("redirect",["data" => $redirect, "edit" => $editredirect]);
	}
}