<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Task;
use \Sonata\Image;
class Facebook extends Task {

	public function __construct()
	{
	    parent::__construct();
	   
	}
	public function info(){
		$arv = [];
		$arv = [
			"name" => "Facebook Auto Posts",
			"version" => "1.2",
			"author" => "VTB PLUS",
			"time"	=>	"* * * * *"
		];
		return $arv;
	}
	public function index()
	{
		
	}
}

?>