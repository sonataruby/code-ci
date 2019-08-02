<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\FrontEnd;
class Content extends FrontEnd {

	public function info($url){
		$data = $this->pages_model->getData($url);
		$this->setTitle($data->name)
			->setDescription($data->description)
			->setKeyword($data->keyword)
			->view('page',["data" => $data]);
	}
}
