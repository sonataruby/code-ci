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
	public function info($url,$channel=false){
		
		
		$data = $this->posts_model->getData($url, false, false, true);
		$catalog = $this->catalog_model->dropdown(false,"ul");
		
		$this->setTitle($data->name)
			->setImage($data->image)
			->setDescription($data->description)
		 	->channel($data->channel)
			->view('post',["data" => $data, "catalog" => $catalog]);
	}

	public function catalog($url,$channel=false){

		$data = $this->catalog_model->getData($url,false, true, true);
		
		if($data && count($data->posts) < 2 && count($data->posts) > 0){
			$post = array_pop($data->posts);
			$this->go(($post->channel ? $post->channel."/post" : "post")."/{$post->url}.html");
		}
		
		$this->setTitle($data->catalog_name)
			->channel($data->channel)
			->view('catalog',["data" => $data]);
	}
}
