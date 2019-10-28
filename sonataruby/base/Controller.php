<?php
namespace Sonata;
defined('BASEPATH') OR exit('No direct script access allowed');
require_once CMS_HMVCPATH."Controller.php";
use Exception;
use stdClass;
use \MX_Controller;
use \Sonata\Forms;
use \Sonata\Shortcode;

use \Sonata\Rest;
use \Sonata\Components;
use \Sonata\Security;

class Controller extends MX_Controller {

	public $setLayout = "default";
	public $channelLayout = false;
	public $settings = [];
	public $allowAjax = true;
	public $store_id = 0;
	public $header = [
			"title" => "CMS Blockchain 4.0", 
			"description" => "Advanced cloud hosting platform with 24/7 Expert Support &amp; 8 Datacenter Locations. We will handle caching, transfers, security, updates.", 
			"keyword" => "", 
			"image" => ""
		];
	private $is_load = false;
	function __construct()
	{
		if($this->is_load == true){

			return $this;
		}

		parent::__construct();
		
		$this->load->helper(['date','cookie','url','form','string','text','html']);
		$this->load->library(['session','email','user_agent','form_validation']);
		$this->lang->load("globals");
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
		
		$this->domain = strtolower(str_replace(['http://','https://','www.','/'],'', base_url()));

		/*
		Load Main Config
		*/
		if(file_exists(CONFIG_LOCAL . "mainconfig.json")){
			$json = json_decode(file_get_contents(CONFIG_LOCAL ."mainconfig.json"));
			foreach ($json as $key => $value) {

				$this->config->set_item($key, isObject($value));
				$this->settings[$key] = isObject($value);
			}
		}else{
			$readdb = $this->db->get_where("stores",["store_domain" => DOMAIN, "is_root" => 1])->row();

			if($readdb){
				$this->config->set_item("root_domain", json_decode(json_encode(["domain" => $readdb->store_domain, "store_id" => $readdb->store_id])));
			}
			
		}

		if(file_exists(CONFIG_LOCAL . "language.json")){
			$json = (Array)json_decode(file_get_contents(CONFIG_LOCAL ."language.json"));
			$this->config->set_item("language_list",$json);
		}

		/*
		Cache Mutile language
		*/
		if($this->input->get("language")){
			$this->session->set_userdata("language",$this->input->get("language"));
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
		if($this->session->userdata('language') && $this->session->userdata('language') != ""){
			$this->config->set_item("language",$this->session->userdata('language'));
		}

		$this->config->set_item("default_channel",CHANNEL_DEFAULT);
		$this->config->set_item("template",'default');


		if(file_exists(CONFIG_LOCAL . DOMAIN.".json")){
			$json = json_decode(file_get_contents(CONFIG_LOCAL . DOMAIN.".json"));
			
			if(!defined("TEMPLATE_ACTIVE")){
				define("TEMPLATE_ACTIVE", (@$json->template ? $json->template : "default"));
			}
			$this->config->set_item("default_channel",CHANNEL_DEFAULT);
			
			foreach ($json as $key => $value) {

				$this->config->set_item($key, isObject($value));
				$this->settings[$key] = isObject($value);
			}

			$this->setTitle(@$json->site_name);
			$this->setDescription(@$json->site_description);
			$this->setKeyword(@$json->site_keyword);
			$this->setImage(@$json->banner);
		}



		$this->forms = new Forms;
		$this->shortcode = new Shortcode;
		$this->parser = $this->load->parser;
		$this->components = $this->load->components;
		$this->access = $this->load->access;
		$this->settings_model->reports();
		

		if(isset($this->config->item("root_domain")->domain) && $this->config->item("root_domain")->domain == DOMAIN){
			$this->store_id = $this->config->item("root_domain")->store_id;
		}else{
			$allow_domain = (array)$this->config->item("allow_domain");
			if(isset($allow_domain[DOMAIN])){
				$this->store_id = $allow_domain[DOMAIN];
			}else{
				die("Domain not allow");
			}
		}
		
		$this->menu_model->setStore($this->store_id);
		$this->settings_model->setStore($this->store_id);
		$this->layout_model->setStore($this->store_id);
		$this->pages_model->setStore($this->store_id);
		$this->catalog_model->setStore($this->store_id);
		$this->posts_model->setStore($this->store_id);
		$this->gallery_model->setStore($this->store_id);
		
		$this->is_load = true;
		
	}

	public function setLayout($layout=""){
		if($layout) $this->setLayout = $layout;
		return $this;
	}

	public function channel($layout=""){
		if($layout) $this->channelLayout = $layout;

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
		if($text) $this->header["description"] = substr(strip_tags($text),0,255);
		return $this;
	}

	public function setImage($text){
		if(is_array($text)) $text = array_pop($text);
		if($text) $this->header["image"] = $text;
		return $this;
	}

	public function view($file, $data=[]){
		$data_pate = [];
		
		foreach ($this->lang->language as $key => $value) {
			$data_pate["lang_".$key] = $value;
		}
		$data_pate['assets'] = "";
		
		if(is_ajax() && $this->allowAjax){
			$content =  $this->load->view("{$file}",$data,true);
			return $this->parser->parse_string($content, $data_pate);
			
		}
		

		$content = $this->load->view("{$file}",$data,true);
		

		//$content = $this->parser->parse_string($content, $data_pate, true);
		return $this->parser->parse_string($this->load->view("layout/".$this->setLayout,["content" => $content, "data" => $data, "header" => $this->header, "report" => $this->getFlash()], true),$data_pate, false);

		
	}

	public function offset_layout($file , $target = "layout"){
		$file_offset = CMS_THEMEPATH . TEMPLATE_ACTIVE . DIRECTORY_SEPARATOR . $target . DIRECTORY_SEPARATOR . $file . "-".str_replace('.','-',DOMAIN).".php";

		if(file_exists($file_offset)){

			return $target .DIRECTORY_SEPARATOR. $file."-".str_replace('.','-',DOMAIN);
		}
		return false;
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

	public function toJson($arv, $return=false){
		
		if(!$return){
			header("Content-type: application/json; charset=utf-8");
			print_r(json_encode($arv));
		}else{
			return json_encode($arv);
		}
		
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
			'fr-fic','fr-dib','fr-dii',
			'}{/components}'// fix emtpty config components
		];
		$replace = [
			'',
			'',
			'</div>',
			'','','',
			'} {/components}'
		];

		$text = str_replace($search,$replace,$text);
		$plugin = ['content'];
		foreach ($plugin as $key => $value) {
			$text = str_replace('<div class="plugins '.$value.'"></div>', '{'.$value.'}', $text);
		}
		return trim($text);
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


	public function urlactive(){
		return str_replace(site_url(), '', current_url());
	}
	/*
	Access Validate
	*/
	public function isLogin($return=false){
		$info = $this->session->userdata("logininfo");
		
		if($return){
			if(!$info) $this->go("account/login?ref=".$this->urlactive());
		}else{
			if(!$info) return false;
		}
		
	}

	public function isEnterprise(){
		$this->isLogin(true);
		$info = $this->session->userdata("logininfo");
		
		if(!$info) return false;
		if($info->account_type == "enterprise"){
			return true;
		}
		return false;
	}

	public function isPersonal(){
		$this->isLogin(true);
		$info = $this->session->userdata("logininfo");
		if(!$info) return false;
		if($info->account_type == "personal"){
			return true;
		}
		return false;
	}


}
