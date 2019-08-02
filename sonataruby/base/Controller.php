<?php
defined('BASEPATH') OR exit('No direct script access allowed');
namespace Sonata;
require_once CMS_HMVCPATH."Controller.php";
use Exception;
use stdClass;
use \MX_Controller;
use \Sonata\Forms;
class Controller extends MX_Controller {

	public $setLayout = "default";
	public $header = ["title" => "CMS Blockchain 4.0", "description" => "Advanced cloud hosting platform with 24/7 Expert Support &amp; 8 Datacenter Locations. We will handle caching, transfers, security, updates.", "keyword" => "", "image" => ""];
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(['url','form','string','text']);
		$this->load->library(['session','email','user_agent','form_validation']);
		$this->load->model(['account/account_model','pages/pages_model','posts/catalog_model','posts/posts_model','posts/gallery_model']);
		$this->forms = new Forms;
		$this->domain = str_replace(['http://','https://','www.','/'],'', base_url());
		define("TEMPLATE_ACTIVE","default");
		
	}

	private function setLayout($layout=""){
		$this->setLayout = $layout;
		return $this;
	}
	public function setTitle($text){
		$this->header["title"] = $text;
		return $this;
	}

	public function setKeyword($text){
		$this->header["keyword"] = $text;
		return $this;
	}

	public function setDescription($text){
		$this->header["description"] = $text;
		return $this;
	}

	public function setImage($text){
		$this->header["image"] = $text;
		return $this;
	}

	public function view($file, $data=[]){
		if(is_ajax()){
			return $this->load->view("{$file}",$data);
		}
		$content = $this->load->view("{$file}",$data,true);
		return $this->load->view("layout/".$this->setLayout,["content" => $content, "data" => $data, "header" => $this->header]);
	}



	/*
	Validate Method
	*/
	public function isPost(){
		if($this->input->method() == "post"){
			return true;
		}
		return false;
	}

	public function isPut(){
		if($this->input->method() == "put"){
			return true;
		}
		return false;
	}

	public function isGet(){
		if($this->input->method() == "get"){
			return true;
		}
		return false;
	}


	public function go($path=""){
		redirect($path ? $path : $this->uri->uri_string());
	}

	public function flash($key, $content=""){
		$this->session->set_flashdata($key, $content);
	}

	public function toJson($arv){
		header("Content-type: application/json; charset=utf-8");
		print_r(json_encode($arv));
	}


	
	public function getFlash(){
		$html = "";
		if($this->session->flashdata("error")){
			$html = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>'.lang("error").'!</strong> '.$this->session->flashdata("error").'.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>';
		}

		if($this->session->flashdata("success")){
			$html = '<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>'.lang("success").'!</strong> '.$this->session->flashdata("success").'.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>';
		}


		if($this->session->flashdata("warning")){
			$html = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>'.lang("warning").'!</strong> '.$this->session->flashdata("warning").'.
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>';
		}


		return $html;
	}

	public function clearContent($text){
		$text = str_replace('<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>','',$text);
		return $text;
	}
}
