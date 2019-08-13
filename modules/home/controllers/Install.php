<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Install as frInstall;
class Install extends frInstall {
	public function index(){
		$install = false;
		if($this->input->method() == "post"){
			if($this->saveConfig()){
				redirect(site_url());
			}else{
				redirect(site_url("install"));
			}
		}

		$this->load->view("install");
	}

	
}