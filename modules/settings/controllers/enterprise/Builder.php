<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Builder extends Enterprise {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper(['directory','file']);
	}

	public function index(){
		$this->view('builder-mobile');
	}

	public function support(){
		$value = ($this->config->item("support_mobile") == "true" ? "false" : "true");
		$this->settings_model->save(["support_mobile" => $value]);
		$this->go("/settings/enterprise/builder");
	}
}