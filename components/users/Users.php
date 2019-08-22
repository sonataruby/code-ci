<?php
use Sonata\Controller;
class Users extends Controller{
	function __construct()
	{
		
		$this->load->registerView( __DIR__ );
		
		//$this->main($arv, $arv2);
	}

	public function main($type, $attr=[]){
		$type = ($type ? "-{$type}" : "");
		
		$profile = new stdClass;
		$profile->avatar = "libs/image/nophoto.jpg";
		$profile->firstname = "..";
		$profile->lastname = ".";
		$data = $this->session->userdata("logininfo");
		if(isset($attr->account_id)){
			$profile = $this->account_model->getInfo($attr->account_id);
			if(!$profile){
				$profile = new stdClass;
				$profile->avatar = "libs/image/nophoto.jpg";
				$profile->firstname = "..";
				$profile->lastname = ".";
			}
		}
		return $this->load->view("components/users{$type}",["attr" => $attr, "data" => $data, "profile" => $profile]);
	}


}