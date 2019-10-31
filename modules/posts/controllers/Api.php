<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Services;
use \Sonata\Definitions;
class Api extends Services {

	function __construct(){
		$config = array();
		include(APPPATH . "/config/rest.php");
		$config["rest_auth"] = false;
		parent::__construct($config);
		$this->load->helper(['date','cookie','url','form','string','text']);
		$this->load->model(['pages/pages_model','posts/posts_model','posts/catalog_model','posts/gallery_model']);
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


	public function list_get($channel="blogs")
	{
		$language = ($this->get("language") ? $this->get("language") : $this->config->item("language"));
		$data = $this->posts_model->getList(["channel" => $channel],$language);

		$this->response(["server" => site_url(),"data" => $data]);
	}

	public function catalog_get()
	{
		$language = ($this->get("language") ? $this->get("language") : $this->config->item("language"));
		$data = $this->catalog_model->getList($language, true);
		$this->response($data);
		
	}
}