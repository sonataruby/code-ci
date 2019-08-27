<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Addon extends Enterprise {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper(['directory','file']);
	}

	public function index(){
		$this->view('addon');
	}


	public function manager(){
		$location = directory_map(array_keys(CMS_MODULESPATH)[0], true);
		$arv = [];
		$ingore = ["account","api","home","pages","posts","settings"];
		foreach ($location as $key => $value) {
			$rfolder = str_replace('/', '', $value);
			if(!in_array($rfolder, $ingore)){
				$arv[$rfolder] = json_decode(read_file(array_keys(CMS_MODULESPATH)[0] . $rfolder . "/info.json"));
			}
		}

		$dataRead = $this->settings_model->getData();
		$module = isObject(@$dataRead->module);
		$module = (empty($module) ? [] : (array)$module);
		print_r($module);
		$this->view('addon-manager', ["location" => $arv]);
	}

	public function install($modules){
		$arv = json_decode(read_file(array_keys(CMS_MODULESPATH)[0] . $modules . "/info.json"));

		$dataRead = $this->settings_model->getData();
		$module = isObject(@$dataRead->module);
		$module = (empty($module) ? ["name" => [],"task" => [], "before" => [], "after" => [], "hook" => []] : (array)$module);
		
		$data = [];
		$arvData = [];
		$arvRegister = (array)@$arv->register;
		foreach ($arvRegister as $key => $value) {
			if($value){
				$arvData[$key] = (array)$value;
			}
		}
		$module["name"] = @array_merge((array)$module["name"], [$modules => true]);
		$module["task"] = @array_merge((array)$module["task"], $arvData["task"]);
		$module["before"] = @array_merge((array)$module["before"], $arvData["before"]);
		$module["after"] = @array_merge((array)$module["after"], $arvData["after"]);
		$module["hook"] = @array_merge((array)$module["hook"], $arvData["hook"]);
		
		

		$json = $this->tojson($module, true);


		$this->settings_model->save(["module" => $json]);

		$this->go("settings/enterprise/addon/manager");
	}


	public function search(){
		$this->view($this->get_views('addon-search'));
	}



	public function searchitem(){
		$keyword = $this->input->get("keyword");
		$data = json_decode(@file_get_contents($this->server_api_url."addon/search?keyword=".$keyword));
		$this->view('addon-search-item',["data" => $data]);
	}



	public function plugins(){
		$path = array_keys(CMS_MODULESPATH)[0];
		$location = directory_map($path, true);
		$arv = [];
		foreach ($location as $key => $value) {
			$spath = $path.$value."plugins/";
			if(is_dir($spath)){
				$arv2 = [];
				$skey = str_replace([$path,'plugins/'], '', $spath);
				$arv2[$skey] = directory_map($spath,false);

				foreach ($arv2 as $keyS => $valueS) {

					foreach ($valueS as $keyK => $valueK) {

						if(strrpos($valueK, "_pi.php") !== false){
							$mkey = $keyS.strtolower(str_replace('_pi.php','',$valueK));
							$arv[$mkey] = ["name" => str_replace('_pi.php','',$valueK), "modules" => ucfirst(str_replace('/','',$value))];
						}
					}
					
				}
			}
		}
		if($this->input->get("active")){
			$arvData = [];
			foreach ($arv as $key => $value) {
				$arvData[strtolower($value["modules"]."/".$value["name"])] = $value["name"];
			}
			$this->settings_model->save(["plugins" => json_encode($arvData)]);
			$this->go("settings/enterprise/addon/plugins");
		}

		if($this->input->get("off")){
			$readData = (array)config_item("plugins");
			unset($readData[$this->input->get("off")]);
			$this->settings_model->save(["plugins" => json_encode($readData)]);
			$this->go("settings/enterprise/addon/plugins");

		}

		if($this->input->get("on")){
			$readData = (array)config_item("plugins");
			$readData = array_merge($readData,[$this->input->get("on") => ucfirst(basename($this->input->get("on")))]);
			$this->settings_model->save(["plugins" => json_encode($readData)]);
			$this->go("settings/enterprise/addon/plugins");

		}


		$active = config_item("plugins");
		$this->view('addon-plugins',["data" => $arv, "active" => $active]);
	}
}