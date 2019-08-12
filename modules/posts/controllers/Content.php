<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\FrontEnd;
use \Sonata\Parser;
class Content extends FrontEnd {


	public function index(){
		$dataGet = $this->posts_model->getList();
		$data = new stdClass;
		$data->posts = $dataGet;
		$data->listCatalog = $this->catalog_model->dropdown(false,"ul");
		$this->setTitle("All Posts")
			->view('catalog',["data" => $data]);
	}
	public function info($url){
		
		
		$data = $this->posts_model->getData($url, false, true, true);
		$catalog = $this->catalog_model->dropdown(false,"ul");
		$this->setTitle($data->name)
			->view('post',["data" => $data, "catalog" => $catalog]);
	}

	public function catalog($url){

		$data = $this->catalog_model->getData($url,false, true, true);
		
		$this->setTitle($data->catalog_name)
			->view('catalog',["data" => $data]);
	}
}
