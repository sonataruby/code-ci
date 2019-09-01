<?php
use Sonata\Controller;
class Image extends Controller{
	function __construct()
	{
		
		$this->load->registerView( __DIR__ );
		
		//$this->main($arv, $arv2);
	}

	public function main($type=false, $attr=["class" => "w-100"]){
		
		
		
		$view = "image";
		$data = isObject($type);
		if(is_array($data)){
			$view = "image-slider";
		}else{

			if (strpos($data, 'http://') !== false || strpos($data, 'https://') !== false) {
			   $data = $data;
			}else{
				$data = site_url($data);
			}

			
		}

		
		return $this->load->view("components/".$view,["attr" => $attr, "data" => $data]);
	}


}