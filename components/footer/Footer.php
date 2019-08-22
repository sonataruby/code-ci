<?php
use Sonata\Controller;
class Footer extends Controller{
	function __construct()
	{
		
		$this->load->registerView( __DIR__ );
		
		//$this->main($arv, $arv2);
	}

	public function main($type, $attr=[]){
		$type = ($type && $type !== "footer" ? "-{$type}" : "");
		return $this->load->view("components/footer{$type}",["attr" => $attr]);
	}


}