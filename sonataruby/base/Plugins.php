<?php
namespace Sonata;
defined('BASEPATH') OR exit('No direct script access allowed');

use Exception;
use stdClass;
use \Sonata\Controller;

class Plugins extends Controller{
	function __construct()
	{
		parent::__construct();
		if(!defined("IS_FRONTEND")) define("IS_FRONTEND",true);
		if(!defined("IS_PLUGINS")) define("IS_PLUGINS",true);
	}

	public function view($file, $data=[]){
		
		
		return $this->load->view("plugins/{$file}",$data, true);
	}

	
}
