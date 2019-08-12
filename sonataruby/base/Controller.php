<?php
defined('BASEPATH') OR exit('No direct script access allowed');
namespace Sonata;
require_once CMS_HMVCPATH."Controller.php";
use Exception;
use stdClass;
use \MX_Controller;
use \Sonata\Forms;
use \Sonata\Shortcode;
use \Sonata\Parser;
use \Sonata\Rest;
use \Sonata\Components;
class Controller extends MX_Controller {

	public $setLayout = "default";
	public $header = ["title" => "CMS Blockchain 4.0", "description" => "Advanced cloud hosting platform with 24/7 Expert Support &amp; 8 Datacenter Locations. We will handle caching, transfers, security, updates.", "keyword" => "", "image" => ""];
	function __construct()
	{
		parent::__construct();
		
		$this->load->helper(['date','cookie','url','form','string','text']);
		$this->load->library(['session','email','user_agent','form_validation']);
		$this->load->model([
			'settings/menu_model',
			'settings/settings_model',
			'account/account_model',
			'pages/layout_model', 
			'pages/pages_model',
			'posts/catalog_model',
			'posts/posts_model',
			'posts/gallery_model'
		]);
		$this->forms = new Forms;
		$this->domain = strtolower(str_replace(['http://','https://','www.','/'],'', base_url()));

		if(file_exists(CONFIG_LOCAL . DOMAIN.".json")){
			$json = json_decode(file_get_contents(CONFIG_LOCAL . DOMAIN.".json"));
			
			if(!defined("TEMPLATE_ACTIVE")){
				define("TEMPLATE_ACTIVE", $json->template);
			}
			foreach ($json as $key => $value) {

				$this->config->set_item($key, isObject($value));
			}

			$this->setTitle(@$json->site_name);
			$this->setDescription(@$json->site_description);
			$this->setKeyword(@$json->site_keyword);
			$this->setImage(@$json->banner);
		}
		$this->shortcode = new Shortcode;
		$this->parser = new Parser;
		$this->components = new Components;
		//define("TEMPLATE_ACTIVE","default");
		
	}

	private function setLayout($layout=""){
		if($layout) $this->setLayout = $layout;
		return $this;
	}
	public function setTitle($text){
		if($text) $this->header["title"] = $text;
		return $this;
	}

	public function setKeyword($text){
		if($text) $this->header["keyword"] = $text;
		return $this;
	}

	public function setDescription($text){
		if($text) $this->header["description"] = $text;
		return $this;
	}

	public function setImage($text){
		if($text) $this->header["image"] = $text;
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
		$search = [
			'<p data-f-id="pbf" style="text-align: center; font-size: 14px; margin-top: 30px; opacity: 0.65; font-family: sans-serif;">Powered by <a href="https://www.froala.com/wysiwyg-editor?pb=1" title="Froala Editor">Froala Editor</a></p>',
			'<p><br></p>',
			'<br></div>',
			'fr-fic','fr-dib','fr-dii'
		];
		$replace = [
			'',
			'',
			'</div>',
			'','',''
		];

		$text = str_replace($search,$replace,$text);
		$plugin = ['content'];
		foreach ($plugin as $key => $value) {
			$text = str_replace('<div class="plugins '.$value.'"></div>', '{'.$value.'}', $text);
		}
		return $text;
	}


	public function connectapi($server="https://localhost",$user="admin", $pass="1234"){
		$rest = new Rest([
			"server" => $server,
			'http_user' => $user,
	        'http_pass' => $pass,
	        'http_auth' => 'basic', // or 'digest' 'basic'
	        'api_name' => "",
	        'api_key' => "",
	        'ssl_verify_peer' => false,
	        'ssl_cainfo' => false
		]);
		return $rest;
	}
	public function postAPI($uri, $arv=[]){
		
		return $this->connectapi()->post($uri, $arv);
	}

	public function getAPI($uri, $arv=[]){
		return $this->connectapi()->get($uri, $arv, 'json');
	}
	
	public function putAPI($uri, $arv=[]){
		return $this->connectapi()->put($uri, $arv, 'json');
	}

	

	public function patchAPI($uri, $arv=[]){
		return $this->connectapi()->patch($uri, $arv, 'json');
	}

	public function deleteAPI($uri, $arv=[]){
		return $this->connectapi()->delete($uri, $arv, 'json');
	}




}
