<?php
defined('BASEPATH') OR exit('No direct script access allowed');
namespace Sonata;
use Exception;
use stdClass;
use \CI_Model;
class Model extends CI_Model{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library("pagination");
		
	}
}