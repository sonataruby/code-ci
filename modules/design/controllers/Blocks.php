<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\FrontEnd;
class Blocks extends FrontEnd {

	
	public function index()
	{
		header('Content-Type: text/javascript;charset=utf-8');
		$data = $this->db->get("design_blocks")->result();
		return $this->load->view("blocks-design", ["data" => $data]);
	}
}