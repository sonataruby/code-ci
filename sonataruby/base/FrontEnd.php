<?php
namespace Sonata;
defined('BASEPATH') OR exit('No direct script access allowed');
use Exception;
use stdClass;
use \Sonata\Controller;

class FrontEnd extends Controller{
	function __construct()
	{
		parent::__construct();
		define("IS_FRONTEND",true);
	}
}
