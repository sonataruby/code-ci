<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\FrontEnd;
use \Sonata\Parser;
class Content extends FrontEnd {

	public function info($url){
		
		
		$data = $this->pages_model->getData($url);

		$offset_layout =  $this->offset_layout($data->layout);
		if($offset_layout){
			$view = $offset_layout;
		}else{
			$layout = $this->layout_model->getData($data->layout);
			if($layout){

			}else{
				$view = "page";
			}
		}
		

		
		
		$this->setTitle($data->name)
			->setDescription($data->description)
			->setKeyword($data->keyword)
			->view($view,["data" => $data]);
	}


	

}
