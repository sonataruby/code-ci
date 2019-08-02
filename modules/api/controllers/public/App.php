<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Services;
use \Sonata\Definitions;
class App extends Services {

	function __construct(){
		$config = array();
		include(APPPATH . "/config/rest.php");
		$config["rest_auth"] = false;
		parent::__construct($config);
		$this->load->model(['pages/pages_model','posts/posts_model','posts/catalog_model']);
	}
	public function index_get()
	{
		$this->response(["status" => "khoa"]);
	}

	public function page_get()
	{
		$language = ($this->get("language") ? $this->get("language") : $this->config->item("language"));
		$data = $this->pages_model->getList($language);
		$this->response($data);
	}


	public function post_get()
	{
		$language = ($this->get("language") ? $this->get("language") : $this->config->item("language"));
		$data = $this->posts_model->getList($language);

		$this->response(["server" => "http://192.168.1.10","data" => $data]);
	}

	public function catalog_get()
	{
		$language = ($this->get("language") ? $this->get("language") : $this->config->item("language"));
		$data = $this->catalog_model->getList($language, true);
		$this->response($data);
		
	}


	public function gallery_get()
	{
		
		$data = $this->posts_model->getListGallery();

		$this->response(["server" => "http://192.168.1.10","data" => $data]);
	}

}
