<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Tags extends Enterprise {

	public function __construct()
	{
	    parent::__construct();
	   
	}
	public function index()
	{
		return $this->video();
	}

	/*
	Gallery
	*/
	public function video(){
		$this->view($this->get_views('video'),[]);
	}
}