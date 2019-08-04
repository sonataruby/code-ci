<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Plugins;
class Contact extends Plugins {

	public function index()
	{
		$this->view('home');
	}
}
