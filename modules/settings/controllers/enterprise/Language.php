<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Language extends Enterprise {
	
	public function __construct()
	{
	    parent::__construct();
	    $this->settings_model->setStore($this->store_id);
	    $this->load->helper('directory');
	}
	public function index(){
		$this->manager();
	}


	public function manager(){
		$dir = directory_map(APPPATH. "/language", true);
		$json = [];
		if(file_exists(CONFIG_LOCAL . "language.json")){
			$json = (Array)json_decode(file_get_contents(CONFIG_LOCAL ."language.json"));
			
		}

		$arv = [];
		foreach ($dir as $key => $value) {
			if(is_dir(APPPATH. "/language/{$value}")){
				$exdata = str_replace('/', '', $value);
				$arv[$exdata] = @isset($json[$exdata]) ? $json[$exdata] : $exdata;
			}
		}
		
		$this->view("language",["data" => $arv]);
	}

	public function tranlaytion($language="", $file=""){
		$allfile = directory_map(APPPATH. "/language/{$language}", false);
		$lang = [];
		if(file_exists(APPPATH. "/language/{$language}/{$file}") && $file){
			
			if(!$lang) include APPPATH. "/language/{$language}/{$file}";
		}

		if($this->isPost()){
			$arv = [];
			$arv[] = '<?php';
			$arv[] = '$lang = [];';
			$keys = $this->input->post("keys");
			$value = $this->input->post("value");
			foreach ($keys as $key => $values) {
				$arv[] = '$lang["'.$values.'"] = "'.$value[$key].'";';
			}
			
			$data = implode($arv, "\n");
			write_file(APPPATH. "/language/{$language}/{$file}",$data);
			$this->go("settings/enterprise/language/tranlaytion/{$language}/{$file}");
		}
		$this->view("language-tranlaytion",["data" => $allfile, "path" => $language, "file" => $file, "row" => $lang]);
	}


	public function edit($language=""){
		$file = CONFIG_LOCAL ."language.json";

		$arv = config_item("language_list");
		if($this->isPost()){
			$arv[$language] = new stdClass;
			$arv[$language]->name = $this->input->post("name");
			$arv[$language]->folder = $language;
			$arv[$language]->flag = $this->input->post("flag");
			$arv[$language]->status = $this->input->post("status");
			$arv[$language]->tags = $this->input->post("tags");
			
			$data = json_encode($arv);
			write_file($file,$data);
			$this->flash("success","All Data Save");
			$this->go("/settings/enterprise/language");
		}
		
		

		$this->view("language-edit", ["data" => @config_item("language_list")[$language]]);
	}

	public function copy($source=""){
		if($this->isPost()){
			$allfile = directory_map(APPPATH. "/language/{$source}", false);
			$folder = $this->input->post("folder");
			if(@mkdir(APPPATH. "/language/{$folder}",0777,true)){

				foreach ($allfile as $keyFile => $valueFile) {
					write_file(APPPATH. "/language/{$folder}/{$valueFile}",file_get_contents(APPPATH. "/language/{$source}/{$valueFile}"));
				}
				$file = CONFIG_LOCAL ."language.json";

				$arv = config_item("language_list");
				$arv[$folder] = new stdClass;
				$arv[$folder]->name = $this->input->post("name");
				$arv[$folder]->folder = $folder;
				$arv[$folder]->flag = $this->input->post("flag");
				$arv[$folder]->status = $this->input->post("status");
				$arv[$folder]->tags = $this->input->post("tags");
				
				$data = json_encode($arv);
				write_file($file,$data);
				$this->flash("success","All Data Save");
				$this->go("/settings/enterprise/language");
			}
			
		}
		$this->view("language-edit", ["copy" => $source]);
	}
}