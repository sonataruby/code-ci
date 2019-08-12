<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Sonata\Plugins;

class Posts_pi extends Plugins
{
	
	public function data($arv=[], $content=""){
		parse_str($content, $urlArray);
		$arv = $arv + $urlArray;
		$theme = (@$arv["theme"] ? "-".@$arv["theme"] : "");
		$limit = (@$arv["limit"] ? intval($arv["limit"]) : 5);
		$search = (@$arv["search"] ? $arv["search"] : "");
		$catalog = (@$arv["catalog"] ? intval($arv["catalog"]) : "");
		$arvInput = [];
		if($catalog){
			$arvInput["catalog"] = $catalog;
		}
		$data = $this->posts_model->getList($arvInput);
		$arv["data"] = $data;
		return $this->view("posts".$theme, $arv);
	}

	public function controller($arv=[]){
		return $this->view("posts", $arv);
	}
}