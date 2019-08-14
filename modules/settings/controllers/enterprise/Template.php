<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Template extends Enterprise {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper('directory');
	}

	public function index(){
		$this->view($this->get_views('addon'));
	}


	public function manager(){
		$location = directory_map(array_keys(CMS_MODULESPATH)[0], true);
		$arv = [];
		$ingore = ["account","api","home","pages","posts","settings"];
		foreach ($location as $key => $value) {
			$rfolder = str_replace('/', '', $value);
			if(!in_array($rfolder, $ingore)){
				$arv[] = $rfolder;
			}
		}

		
		$this->view('template-manager', ["location" => $arv]);
	}

	public function search(){
		
		
		$this->view($this->get_views('template-search'));
	}

	public function searchitem(){
		$keyword = $this->input->get("keyword");
		$data = $this->connectapi($this->server_api_url)->get("public/addon/search",["keyword" => $keyword],'json');
		$this->view($this->get_views('template-search-item'),["data" => ($data ? $data : [])]);
	}

	public function download($hash){
		$data = $this->connectapi($this->server_api_url)->get("public/addon/getfile",["hash" => $hash],'json');
		if(isset($data->price) && $data->price > 0){
			if($this->isPost()){
				$invoice = $this->connectapi($this->server_api_url)->get("public/invoice/validateinvoice",["hash" => $hash],'json');
				if($invoice->status == "ok"){
					$this->_download($hash);
				}
			}
			return $this->view('template-payment', $data);
		}else{
			$this->_download($hash);
		}
	}

	private function _download($hash){
		$invoice = $this->connectapi($this->server_api_url)->get("public/invoice/validateinvoice",["hash" => $hash],'json');
		if(!is_dir(CACHE_LOCAL . "download")) mkdir(CACHE_LOCAL . "download",0775, true);
		if($invoice->status == "ok"){
			
			

			$pathsave = CACHE_LOCAL . "download/{$data->fileSave}";

			file_put_contents($pathsave, file_get_contents($data->callDownload));
		}
	}



	public function header(){
		$dataRead = $this->settings_model->getData();

		$data = isObject(@$dataRead->header);
		if($this->isPost()){
			$config = $this->input->post("config");
			$json = $this->tojson($config, true);
			$this->settings_model->save(["header" => $json]);
			$this->go("/settings/enterprise/template/header");
		}
		$this->view("header-settings",["data" => $data]);
	}


	public function css(){
		$this->load->helper('file');
		$file = read_file(CMS_THEMEPATH . TEMPLATE_ACTIVE . "/styles.css");
		if($this->isPost()){
			$data = $this->input->post("content");
			write_file($file, $data);
			$this->go("settings/enterprise/template/css");
		}
		$this->view("css-settings",["content" => $file]);
	}
}