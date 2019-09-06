<?php
use Sonata\Controller;
class Catalog extends Controller{
	function __construct()
	{
		
		$this->load->registerView( __DIR__ );
		
		//$this->main($arv, $arv2);
	}

	public function main($type, $attr=[]){
		$arv = [];
		$theme = (@$attr["theme"] && file_exists(__DIR__ ."/components/catalog-{$attr["theme"]}.php") ? "-{$attr["theme"]}" : "");
		if($type) $attr["channel"] = $type;


		if(isset($attr["source"]) && ($attr["source"] == "posts" || $attr["source"] == "tabs")){
			$theme = ($attr["source"] == "posts" ? "-posts" : "-tabs");
			$catalog = $this->catalog_model->getList(["channel" => $type]);
			$arv = [];
			foreach ($catalog as $key => $value) {
				$value->posts = $this->posts_model->getList(array_merge(["catalog" => $value->id, "limit" => 10, "channel" => $value->channel], $attr));
				$arv[] = $value;
			}
			
		}

		if(isset($attr["source"]) && $attr["source"] == "menu"){
			$theme = "-menu";
			$arv = $this->catalog_model->getList(["channel" => $type]);
		}

		return $this->load->view("components/catalog{$theme}",["attr" => $attr, "data" => $arv]);
	}


}