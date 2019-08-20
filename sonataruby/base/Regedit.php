<?php
namespace Sonata;
defined('BASEPATH') OR exit('No direct script access allowed');

use Exception;
use stdClass;
class Regedit {

	function __construct()
	{
		$this->CI =& get_instance();
        
	}
	


    public function __call($method, $parameters)
	{
		if(!isset($this->{$method})){
			return ;
		}
	}
}