<?php
namespace Sonata;
defined('BASEPATH') OR exit('No direct script access allowed');

use Exception;
use stdClass;
use \Sonata\Controller;

class Personal extends Controller{
	function __construct()
	{
		parent::__construct();
		$this->isLogin(true);
		define("BASE_PERSONAL", true);
		$this->setTitle("Personal Controller");
	}

	public function view($file, $data=[]){
		return parent::view("personal/{$file}",$data);
	}
	public function get_views($path=""){
		return "personal/{$path}";
	}
}
