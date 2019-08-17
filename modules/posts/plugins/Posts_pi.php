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
		$tag = (@$arv["tag"] ? @$arv["theme"] : "");

		$arvInput = [];
		if($catalog){
			$arvInput["catalog"] = $catalog;
		}
		if(isset($arv["channel"])){
			$arvInput["channel"] = $arv["channel"];
			unset($arv["channel"]);
		}
		if($limit){
			$arvInput["limit"] = $limit;
		}
		if($search){
			$arvInput["search"] = $search;
		}
		
		if($tag){
			$arvInput["tag"] = $tag;
		}

		$data = $this->posts_model->getList($arvInput);
		$arv["data"] = $data;
		return $this->view("posts".$theme, $arv);
	}

	public function controller($arv=[]){
		return $this->view("posts", $arv);
	}
}