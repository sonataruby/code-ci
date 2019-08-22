<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\FrontEnd;
class Dashboard extends FrontEnd {

	
	public function index()
	{
		$layout = $this->layout_model->getData("home");
		$data = [];
		$data["site_name"] = $this->config->item("site_name");
		$data["hotline"] = $this->config->item("hotline");

		if($layout){
			$layout->content = $this->parser->parse_string($this->shortcode->run($layout->content), $data, true);
			$this->view('home-customs',["data" => $layout]);
		}else{
			$this->view('home',["data" => $data]);
		}

		
	}

	public function accessdenied(){
		$this->setTitle("Access Denied");
		$this->view("accessdenied");
	}

	public function show404($url=false){
		
		$redirect = (array)config_item("redirect");
		
		if(isset($redirect[$this->urlactive()])){
			$this->go($redirect[$this->urlactive()]);
		}
		$this->setTitle("Error 404");
		$this->view("404");
	}



	public function sitemap(){
		$pages = $this->pages_model->getList();
		$post = $this->posts_model->getList();
		$catalog = $this->catalog_model->getList();
		$this->load->view("sitemap");
	}


	public function feeds(){
		$this->setTitle("Error 404");
		$this->view("404");
	}


	public function Blockview(){
		$data = [];
		$data["winget_content_as"] = $this->input->post("winget_content_as");
		$data["winget_name"] = $this->input->post("winget_name");
		$data["winget_icon"] = $this->input->post("winget_icon");
		$data["winget_content"] = $this->input->post("winget_content");

		$this->view('blockview',["data" => $data]);
	}
}
