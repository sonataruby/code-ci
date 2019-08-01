<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\FrontEnd;
class Dashboard extends FrontEnd {

	
	public function index()
	{
		$this->view('welcome_message');
	}
}
