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

		
		$this->view($this->get_views('addon-manager'), ["location" => $arv]);
	}

	public function search(){
		$this->view($this->get_views('addon-search'));
	}
}