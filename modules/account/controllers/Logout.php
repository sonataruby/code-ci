<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\FrontEnd;
use \Sonata\Parser;
class Logout extends FrontEnd {
	public function index(){
		$this->go("/");
	}
}