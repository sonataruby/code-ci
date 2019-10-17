<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Personal;
use \Sonata\Parser;
use \Sonata\Image;
class Profile extends Personal {
	public function index(){
		$account_id = $this->session->userdata('logininfo')->account_id;
		$dataUser = $this->account_model->getInfo($account_id);
		if($this->isPost()){
			$image = new Image;
			$data = $this->input->post("config");
			$data["avatar"] = $image->saveImageUpload($data["avatar"], "avatar",[],"avatar-".$account_id);
			$this->account_model->accountInfo($data, $account_id);
			$this->flash("success",lang("success_update"));
			$this->go("account/personal/profile");
		}
		$this->view("profile",["data" => $dataUser]);
	}
}