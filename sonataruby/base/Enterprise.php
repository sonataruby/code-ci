<?php
defined('BASEPATH') OR exit('No direct script access allowed');
namespace Sonata;
use Exception;
use stdClass;
use \Sonata\Controller;

class Enterprise extends Controller{
	function __construct()
	{
		parent::__construct();
		define("BASE_ENTERPRISE", true);
	}

	public function get_views($path=""){
		return "enterprise/{$path}";
	}
}
