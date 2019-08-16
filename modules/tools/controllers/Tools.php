<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Tools extends Enterprise {
	public function index(){
		$this->view("tools");
	}
}