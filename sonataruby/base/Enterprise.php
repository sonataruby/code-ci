<?php
namespace Sonata;
defined('BASEPATH') OR exit('No direct script access allowed');

use Exception;
use stdClass;
use \Sonata\Controller;

class Enterprise extends Controller{
	public $server_api_url = "https://thietkewebvip.com/api/";
	public $server_api_marketings = "https://rao.vn/api/";

	function __construct()
	{
		parent::__construct();
		if(!$this->isEnterprise()){
			$this->go("access-denied.html?ref=".$this->urlactive());
		}
		define("BASE_ENTERPRISE", true);
		$this->setTitle("Administrator");
	}

	public function view($file, $arv=[]){
		return parent::view("enterprise/{$file}", $arv);
	}

	public function get_views($path=""){
		return "enterprise/{$path}";
	}
}
