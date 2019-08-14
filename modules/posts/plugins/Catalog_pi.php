<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Sonata\Plugins;

class Catalog_pi extends Plugins
{
	
	public function data($arv=[], $content=""){
		$arv = $arv + ["item" => json_decode($content)];
		$arv["data"] = $this->catalog_model->dropdown([],false, "ul");
		return $this->view("catalog", $arv);
	}

	public function controller($arv=[]){
		return $this->view("catalog", $arv);
	}
}