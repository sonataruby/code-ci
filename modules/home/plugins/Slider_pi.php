<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Sonata\Plugins;

class Slider_pi extends Plugins
{
	
	public function data($arv=[], $content=""){
		$arv = $arv + ["item" => json_decode($content)];
		return $this->view("slider", $arv);
	}

	public function controller($arv=[]){
		return $this->view("slider", $arv);
	}
}