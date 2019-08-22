<?php
use Sonata\Controller;
class Catalog extends Controller{
	function __construct()
	{
		
		$this->load->registerView( __DIR__ );
		
		//$this->main($arv, $arv2);
	}

	public function main($type, $attr=[]){
		$theme = (@$attr["theme"] && file_exists(__DIR__ ."/components/catalog-{$attr["theme"]}.php") ? "-{$attr["theme"]}" : "");
		if($type) $attr["channel"] = $type;
		
		return $this->load->view("components/catalog{$theme}",["attr" => $attr]);
	}


}