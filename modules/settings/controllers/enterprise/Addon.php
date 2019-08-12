<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Addon extends Enterprise {

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

		
		$this->view('addon-manager', ["location" => $arv]);
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
		print_r(config_item("plugins"));
		$this->view('addon-plugins',["data" => $arv]);
	}
}