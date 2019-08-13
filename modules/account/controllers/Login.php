<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\FrontEnd;
use \Sonata\Parser;
class Login extends FrontEnd {
	public function index(){
		if($this->isPost()){
			$email = $this->input->post("email");
			$password = $this->input->post("password");
			$data = $this->account_model->setLogin($email, $password);
			if($data){
				$this->session->set_userdata('logininfo', $data);
				$ref = $this->input->post("ref");
				$ref = ($ref ? $ref : "account/profile");
				$this->go($ref);
			}else{
				$this->go("account/login?ref=".$this->input->get("ref"));
			}
		}
		return $this->view("login");
	}
}