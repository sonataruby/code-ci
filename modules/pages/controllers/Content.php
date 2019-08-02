<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\FrontEnd;
class Content extends FrontEnd {

	public function info($url){
		$data = $this->pages_model->getData($url);
		$this->setTitle($data->page_name)
			->setDescription($data->page_description)
			->setKeyword($data->page_keyword)
			->view('page',["data" => $data]);
	}
}
