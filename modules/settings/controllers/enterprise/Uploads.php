<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Uploads extends Enterprise {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper(['directory','file']);
	}

	public function image(){
		$config['upload_path']          = UPLOAD_PATH . "image/";
		$config['allowed_types']        = 'gif|jpg|png';
		//$config['max_size']             = 8000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile'))
		{
			print_r($this->upload->display_errors());
		}
		else
		{
			$data = $this->upload->data();
			$image = str_replace(FCPATH,'',$data["full_path"]);
			echo stripslashes(json_encode(["link" => site_url($image)]));
		}
	}

	public function imagemanager(){

	}
}