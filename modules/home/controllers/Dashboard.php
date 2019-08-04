<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\FrontEnd;
class Dashboard extends FrontEnd {

	
	public function index()
	{
		$layout = $this->layout_model->getData("home");
		$data = [];
		if($layout){
			$layout->content = $this->parser->parse_string($this->shortcode->run($layout->content), $data, true);
		}
		$this->view('home',["data" => $layout]);
	}
}
