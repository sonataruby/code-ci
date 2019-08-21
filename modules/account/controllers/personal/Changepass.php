<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Personal;
use \Sonata\Parser;
use \Sonata\Image;
class Changepass extends Personal {
	public function index(){
		$account_id = $this->session->userdata('logininfo')->account_id;
		if($this->isPost()){
			$old = $this->input->post("old_password");
			$new = $this->input->post("new_password");

			if($this->account_model->changepass($old, $new, $account_id)){
				$this->flash("success",lang("success_update"));
				
			}else{
				$this->flash("error",lang("error_update"));
			}
			$this->go("account/personal/changepass");
		}
		$this->view("changepass");
	}
}