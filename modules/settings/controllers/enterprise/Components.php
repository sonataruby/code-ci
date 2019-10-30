<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Components extends Enterprise {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper(['directory','file']);
	}
	public function index(){

	}

	public function list(){

	}

	public function data(){
		
	}
}