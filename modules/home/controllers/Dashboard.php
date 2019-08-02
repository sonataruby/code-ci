<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\FrontEnd;
class Dashboard extends FrontEnd {

	
	public function index()
	{
		print_r("Khoa");
		$this->view('home');
	}
}
