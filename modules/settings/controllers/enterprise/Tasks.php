<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Tasks extends Enterprise {
	private $task = [];
	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper('directory');
	    $arv = directory_map(array_keys(CMS_MODULESPATH)[0],1);
		$arvs = [];
		foreach ($arv as $key => $value) {
			$arvs2 = directory_map(array_keys(CMS_MODULESPATH)[0]."/".$value."/controllers/task/");
			if($arvs2) {
				foreach ($arvs2 as $key2 => $value2) {
					include_once array_keys(CMS_MODULESPATH)[0]."/".$value."/controllers/task/".$value2;
					$class = str_replace('.php', '', $value2);
					$classEx = new $class;
					$this->task[$class] = $classEx->info();
				}
				
			}
		}
	}

	public function index(){

		$this->view("tasks-manager",["task" => $this->task]);
	}
}