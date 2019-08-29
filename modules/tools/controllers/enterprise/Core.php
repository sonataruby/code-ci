<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Core extends Enterprise {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(['directory','file']);
		$this->access->isRoot();
	}
	public function index(){
		$this->view("update-core");
	}

	public function update(){
		$output = "Server không hỗ trợ cập nhập trực tuyến";
		if(function_exists('shell_exec'))
		{
			$output = shell_exec("cd " . FCPATH . " & git pull") ;
		}
		$this->view("update-report",["data" => $output]);
	}
}