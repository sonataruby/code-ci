<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Template extends Enterprise {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper(['directory','file']);
	}

	public function index(){
		$this->view($this->get_views('addon'));
	}


	public function manager(){
		$location = directory_map(CMS_THEMEPATH, true, false);
		$arv = [];
		$ingore = [config_item("template")];
		foreach ($location as $key => $value) {
			$rfolder = str_replace('/', '', $value);
			if(!in_array($rfolder, $ingore) && is_dir(CMS_THEMEPATH . $rfolder)){
				$arv[$rfolder] = json_decode(read_file(CMS_THEMEPATH . $rfolder."/info.json"));
			}
		}
		
		$default = json_decode(read_file(CMS_THEMEPATH . config_item("template")."/info.json"));
		$this->view('template-manager', ["location" => $arv, "data" => $default]);
	}

	public function install($dir){
		$this->settings_model->save(["template" => $dir]);
		$this->go("settings/enterprise/template/manager");
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


		/*
		Read Theme Local
		*/
		$arvLocal = [
                CMS_THEMEPATH . TEMPLATE_ACTIVE . DIRECTORY_SEPARATOR . "apps". DIRECTORY_SEPARATOR ."components" . DIRECTORY_SEPARATOR . "{dir}" . DIRECTORY_SEPARATOR . "components" . DIRECTORY_SEPARATOR, 
                COMPONENTS_LOCAL . "{dir}" . DIRECTORY_SEPARATOR . "components" . DIRECTORY_SEPARATOR
        ];

        $localTheme = [];
        foreach ($arvLocal as $key => $value) {
        	foreach (["header","footer"] as $keyM => $valueM) {
        		$localTheme[$valueM] = (isset($localTheme[$valueM]) ? $localTheme[$valueM] : []);
        		$path = str_replace('{dir}', $valueM, $value);
        		$map = directory_map($path);
        		$localTheme[$valueM] = @array_merge($localTheme[$valueM], $map,["path" => $path]);
        	}
        }

        $makeItem = [];
        foreach ($localTheme as $key => $value) {
        	$setpath = $value["path"];

        	foreach ($value as $keyM => $valueM) {
        		$valueM = str_replace(['header-','footer-','.php'], '', $valueM);
    			if($keyM !== "path" && $valueM){
    				if(file_exists($setpath . "{$valueM}.png")){
    					$file = str_replace(FCPATH,'',$setpath . "{$valueM}.png");
    				}else{
    					$file = "libs/image/nophoto.jpg";
    				}
	        		$makeItem[$key][$valueM] = $file;
	        	}
        	}
        	
        	
        	
        }

        

		$this->view("header-settings",["data" => $data, "theme" => $makeItem]);
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


	public function Blocks($id=false){
		if($this->isPost()){
			$data = [];
			$data["winget_content_as"] = $this->input->post("winget_content_as");
			$data["winget_name"] = $this->input->post("winget_name");
			$data["winget_icon"] = $this->input->post("winget_icon");
			$data["winget_content"] = $this->clearContent($this->input->post("winget_content"));
			$data["winget_display"] = $this->input->post("winget_display");
			$data["winget_display"] = $this->input->post("winget_display");
			$this->layout_model->windget_save($data, $id);
			$this->go("settings/enterprise/template/blocks");
		}
		$data = $this->layout_model->windget_result(false, $this->input->get("filter"));
		$content = $this->layout_model->windget_row($id);
		$this->view("blocks",["data" => $data, "content" => $content]);
	}

	public function Blockssorts(){
		$data = $this->input->post("item");
		$i = 1;
		foreach ($data as $value) {
		    $this->layout_model->windget_save(["winget_sort" => $i], $value);
		    $i++;
		}
	}
}