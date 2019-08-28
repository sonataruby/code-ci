<?php
namespace Sonata;
defined('BASEPATH') OR exit('No direct script access allowed');

use Exception;
use stdClass;
class Securityaccess {

	private $root_domain = [];
	private $allow_domain = [];
	private $domain = "";
	function __construct()
	{
		$this->CI =& get_instance();
        
	}
	private function getInfo(){
		$this->root_domain = $this->CI->config->item("root_domain");
        $this->allow_domain = $this->CI->config->item("allow_domain");
        $this->domain = DOMAIN;
	}
	public function isRoot(){
		$this->getInfo();
		
		if(isset($this->root_domain->domain) || $this->root_domain->domain == $this->domain){
			
			return true;
		}
		die("Domain not allow {$this->domain}");
		return false;
	}


	public function isAllow(){
		$this->getInfo();
		
		if(isset($this->allow_domain[$this->domain])){
			
			return true;
		}
		die("Domain not allow {$this->domain}");
		return false;
	}
    
}
