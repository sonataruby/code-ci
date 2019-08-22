<?php
use Sonata\Controller;
class Header extends Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->registerView( __DIR__ );
		
		//$this->main($arv, $arv2);
	}

	public function main($type, $attr=[]){
		//$this->load->debug(true);
		$type = ($type && $type !== "header" ? "-{$type}" : "");
		
		return $this->load->view("components/header{$type}",["attr" => $attr]);
	}


}