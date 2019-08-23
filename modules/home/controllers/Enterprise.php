<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise as CPEnterprise;
class Enterprise extends CPEnterprise {

	
	public function index()
	{
		$robot = $this->db->get_where("reports_robots", ["bot_name" => $this->agent->robot(),"store" => DOMAIN, "language" => config_item("language")])->result();
		$history = $this->db->order_by("view_update","DESC")->group_by("hash_connect")->limit(20)->get_where("reports_views", ["store" => DOMAIN, "language" => config_item("language"),"is_bot" => 0])->result();
		
		$this->view("home",["robot" => $robot, "history" => $history]);
	}
}
