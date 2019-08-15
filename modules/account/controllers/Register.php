<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\FrontEnd;
use \Sonata\Parser;
class Register extends FrontEnd {
	public function index(){
		if($this->isPost()){
			$email = $this->input->post("email");
			$password = $this->input->post("password");
			$data = $this->account_model->setAccount($email, $password);
			if($data){
				$this->session->set_userdata('login', $this->account_model->setLogin($email, $password));
				$this->go("account/profile");
			}else{
				$this->go("account/register");
			}
		}
		return $this->setTitle('{lang_register}')->view("register");
	}
}