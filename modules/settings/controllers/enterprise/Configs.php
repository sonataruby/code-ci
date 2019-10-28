<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Configs extends Enterprise {

	public function __construct()
	{
	    parent::__construct();
	    $this->settings_model->setStore($this->store_id);
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
		$error = null;
		if(!is_dir(CONFIG_LOCAL)){
			$error = CONFIG_LOCAL." not create, Goto Hosting Panel create folder {CONFIG_LOCAL} and chmod 0777 before config";
		}
		$this->view('config',["data" => $data, "error" => $error]);
	}

	public function api(){
		$data = [];
		$this->view('api',["data" => $data]);
	}



	public function channels(){
		if($this->input->get("setdefault")){
			$this->settings_model->save(["default_channel" => $this->input->get("setdefault")]);
			$this->go("settings/enterprise/configs/channels");
		}
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



	public function Maintain(){
		$dataRead = $this->settings_model->getData();
		if($this->isPost()){
			$maintain = $this->input->post("maintain");
			$maintain_content = $this->clearContent($this->input->post("maintain_content"));
			$this->settings_model->save(["maintain" => $maintain, "maintain_content" => $maintain_content]);
			$this->go("settings/enterprise/configs/maintain");
		}
		$this->view("maintain",["data" => $dataRead]);
	}

	public function page404(){
		$dataRead = $this->settings_model->getData();
		if($this->isPost()){
			$layout = $this->input->post("layout_404");
			$content = $this->clearContent($this->input->post("content_404"));
			$this->settings_model->save(["layout_404" => $layout, "content_404" => $content]);
			$this->go("settings/enterprise/configs/page404");
		}
		$this->view("page404",["data" => $dataRead]);
	}


	/*
	Auto Bot
	*/

	public function autobots(){
		$this->load->helper('file');
		$data = ["shopping" => "true", "bds" => "true", "travel" => "true", "aboutproduct" => "true"];

		if($this->isPost()){
			$solution = $this->input->post("solution");
			$arv = [];
			$global = [
				"menu" => ["/" => "Trang chủ", "page/abouts.html" => "Về chúng tôi", "page/contacts.html" => "Liên hệ"],
				"page" => ["abouts.html" => ["label" => "Về chúng tôi", "layout" => ""], "contacts.html" => ["label" => "Liên hệ", "layout" => "contact"]]
			];

			$dataJson = json_decode(read_file(CMS_ROOTPATH . "libs/solution.json"));
			$arv = [];
			foreach ($solution as $keyS => $valueS) {
				if(isset($dataJson->{$valueS})){
					foreach ($dataJson->{$valueS} as $key => $value) {
						if(isset($global[$key])){
							$arv[$key] = array_merge((array) $value, $global[$key]);
							ksort($arv[$key]);
						}else{
							$arv[$key] = (array) $value;
						}
						
					}
				}

			}
			
			$this->installBuilder($arv);
			
		}
		$this->view("autobots",["data" => $data]);
	}


	private function installBuilder($arv=[]){


		/*
		Create Menu
		*/
		$i = 0;
		$this->menu_model->resetMenu();
		foreach ($arv["menu"] as $key => $value) {
			$this->menu_model->save(["menu_name" => $value, "menu_link" => $key, "menu_sort" => ($i + 1)]);
			$i++;
		}

		/*
		Create Page
		*/
		
		$this->pages_model->delete();
		foreach ($arv["page"] as $key => $value) {
			$url = str_replace('.html', '', $key);
			$name = $value;
			$layout = "";

			if(is_array($value)){
				$name = $value["label"];
				$layout = $value["layout"];
			}
			$this->pages_model->create(false,["page_name" => $name, "page_url" => $url, "page_layout" => $layout]);
			
		}
		/*
		Create Layout
		*/
		
		$this->layout_model->delete();
		foreach ($arv["layout"] as $key => $value) {
			$this->layout_model->create(false,["layout_name" => $value->label, "layout_url" => $key, "layout_content" => read_file(CMS_ROOTPATH . "libs/layout/sample/".$value->filelocal.".php")]);
		}

		/*
		Create Channel
		*/
		if(isset($arv["channel"])){

			foreach ($arv["channel"] as $key => $value) {
				if(isset($value->sample)){
					$this->posts_model->resetData($key);
					$this->posts_model->field_excel["channel"] = $key;
					$this->posts_model->example($value->sample, "posts");
				}
			}
			$json = $this->tojson($arv["channel"], true);
			$this->settings_model->save(["channel" => $json]);
		}


		/*
		Create Slidebar
		*/
		if(isset($arv["slidebar"])){
			$data = [];

			foreach ($arv["slidebar"] as $key => $value) {
				$this->layout_model->windget_reset($key);
				foreach ($value as $keyW => $valueW) {
					if(@$valueW->name && @$valueW->content){
						$data = [];
						$data["winget_content_as"] = isset($valueW->title) ? 1 : 0;
						$data["winget_name"] = $valueW->name;
						//$data["winget_icon"] = $this->input->post("winget_icon");
						$data["winget_content"] = $valueW->content;
						$data["winget_display"] = $key;
						
						$this->layout_model->windget_save($data);
					}
				}
				
				
			}
		}
		print_r($data);
		exit();


	}
}