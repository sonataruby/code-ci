<?php
defined('BASEPATH') OR exit('No direct script access allowed');
namespace Sonata;
use Exception;
use stdClass;
use \Sonata\Controller;

class Personal extends Controller{
	function __construct()
	{
		parent::__construct();
		define("BASE_PERSONAL", true);
	}

	public function get_views($path=""){
		return "personal/{$path}";
	}
}
