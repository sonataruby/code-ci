<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise as CPEnterprise;
use \Sonata\Image;
class Maillist extends CPEnterprise {

	public function __construct()
	{
	    parent::__construct();
	   
	}

	public function index()
	{
		return $this->list();
	}

	public function list(){
		$data = $this->markettings_model->getMailList();
		$this->view('maillist',["data" => $data]);
	}
}