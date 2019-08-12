<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise as CPEnterprise;
class Enterprise extends CPEnterprise {

	
	public function index()
	{
		$this->view("home");
	}
}
