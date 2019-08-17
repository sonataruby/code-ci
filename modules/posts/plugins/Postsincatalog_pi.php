<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Sonata\Plugins;

class Postsincatalog_pi extends Plugins
{
	
	public function data($arv=[], $content=""){
		parse_str($content, $urlArray);
		$arv = $arv + $urlArray;
		$arv["data"] = $this->catalog_model->getList();
		
		return $this->view("post-in-catalog", $arv);
	}

	public function controller($arv=[]){
		return $this->view("catalog", $arv);
	}
}