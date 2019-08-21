<?php
use Sonata\Controller;
class Users extends Controller{
	function __construct()
	{
		
		$this->load->registerView( __DIR__ );
		
		//$this->main($arv, $arv2);
	}

	public function main($type, $attr=[]){
		$type = ($type ? "-{$type}" : "");
		$data = $this->session->userdata("logininfo");
		return $this->load->view("components/users{$type}",["attr" => $attr, "data" => $data]);
	}


}