<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Tasks extends Enterprise {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper('directory');
	}

	public function index(){
		$this->view("tasks-manager");
	}
}