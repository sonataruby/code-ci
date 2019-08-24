<?php
use Sonata\Controller;
class Html5 extends Controller{
	function __construct()
	{
		
		$this->load->registerView( __DIR__ );
		
		//$this->main($arv, $arv2);
	}

	public function main($type, $arv=[]){
		$type = ($type && $type !== "html5" ? "-{$type}" : "");
		return $this->load->view("components/html5{$type}",["attr" => $arv]);
	}
}