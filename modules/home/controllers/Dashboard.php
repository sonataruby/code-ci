<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\FrontEnd;
class Dashboard extends FrontEnd {

	
	public function index()
	{
		$layout = $this->layout_model->getData("home");
		$data = [];
		if($layout){
			$layout->content = $this->shortcode->run($this->parser->parse_string($layout->content, $data, true));
			$this->view('home-customs',["data" => $layout]);
		}else{
			$this->view('home',["data" => $data]);
		}

		
	}

	public function accessdenied(){
		$this->setTitle("Access Denied");
		$this->view("accessdenied");
	}

	public function show404(){
		$this->setTitle("Error 404");
		$this->view("404");
	}



	public function sitemap(){
		$this->setTitle("Error 404");
		$this->view("404");
	}


	public function feeds(){
		$this->setTitle("Error 404");
		$this->view("404");
	}

}
