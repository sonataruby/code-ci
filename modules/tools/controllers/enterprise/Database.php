<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Database extends Enterprise {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(['directory','file']);
		$this->access->isRoot();
	}

	public function index(){
		return $this->view("tools");
	}

	public function reset(){
		return $this->view("reset-database");
	}

	public function runreset(){
		$tables = $this->db->list_tables();
		$ingore = ["account","account_info","migrations","stores"];
		$arvTable = [];
		foreach ($tables as $key => $value) {
			if(!in_array($value, $ingore)){
				$arvTable[] = $value;
			}
		}

		foreach ($arvTable as $key => $value) {
			$this->db->truncate($value);
		}

		$this->settings_model->putDataCache();
		$this->flash("success","All database reset");
		$this->go("/tools/enterprise/database/reset");
	}
}