<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\FrontEnd;
use \Sonata\Parser;
class Content extends FrontEnd {

	public function info($url){
		
		
		$data = $this->pages_model->getData($url);

		$layout = $this->layout_model->getData($data->layout);

		
		
		$this->setTitle($data->name)
			->setDescription($data->description)
			->setKeyword($data->keyword)
			->view('page',["data" => $data]);
	}


	

}
