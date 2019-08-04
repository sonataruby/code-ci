<?php
defined('BASEPATH') OR exit('No direct script access allowed');
namespace Sonata;
use Exception;
use stdClass;
use \Sonata\Controller;

class Plugins extends Controller{
	function __construct()
	{
		parent::__construct();
		if(!defined("IS_FRONTEND")) define("IS_FRONTEND",true);
		define("IS_PLUGINS",true);
	}

	public function view($file, $data=[]){
		
		
		return $this->load->view($this->get_views($file),$data, true);
	}

	public function get_views($path=""){
		return "plugins/{$path}";
	}
}
