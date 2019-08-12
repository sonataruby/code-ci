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
		define("BASE_PERSONAL", true);
		$this->setTitle("Personal Controller");
	}

	public function get_views($path=""){
		return "personal/{$path}";
	}
}
