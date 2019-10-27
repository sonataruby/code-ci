<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise as CPEnterprise;
use \Sonata\Image;
class Manager extends CPEnterprise {

	public function __construct()
	{
	    parent::__construct();
	   
	}

	public function index()
	{
		return $this->list();
	}

	public function list(){
		$data = $this->account_model->getList();
		$this->view('account_manager',["data" => $data]);
	}
}