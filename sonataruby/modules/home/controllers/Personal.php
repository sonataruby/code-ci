<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Personal as CPPersonal;
class Personal extends CPPersonal {

	
	public function index()
	{
		$this->view('home');
	}
}
