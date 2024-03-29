<?php
use Sonata\Controller;
class Slidebar extends Controller{
	function __construct()
	{
		
		$this->load->registerView( __DIR__ );
		
		//$this->main($arv, $arv2);
	}

	public function main($type, $attr=[]){
		$data = $this->layout_model->windget_result(false, @$attr["type"]);
		$type = ($type ? "-{$type}" : "");
		return $this->load->view("components/slidebar{$type}",["data" => $data, "attr" => $attr]);
	}


}