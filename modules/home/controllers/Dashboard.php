<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\FrontEnd;
class Dashboard extends FrontEnd {

	
	public function index()
	{
		$offset_layout =  $this->offset_layout("home");
		if($offset_layout){
			$view = $offset_layout;
		}else{
			$layout = $this->layout_model->getData("home");
			if($layout){
				$view = "home-customs";
			}else{
				$view = "home";
			}
		}
		
		$data = [];
		$data["site_name"] = $this->config->item("site_name");
		$data["hotline"] = $this->config->item("hotline");

		
		$this->view($view,["data" => $data]);

		
	}

	public function accessdenied(){
		$this->setTitle("Access Denied");
		$this->view("accessdenied");
	}

	public function show404($url=false){
		
		$redirect = (array)config_item("redirect");
		
		if(isset($redirect[$this->urlactive()])){
			$this->go($redirect[$this->urlactive()]);
		}
		$this->setTitle("Error 404");
		$this->view("404");
	}



	public function sitemap(){
		$pages = $this->pages_model->getList();
		$post = $this->posts_model->getList();
		$catalog = $this->catalog_model->getList();
		$this->load->view("sitemap");
	}


	public function feeds(){
		$this->setTitle("Error 404");
		$this->view("404");
	}


	public function Blockview(){
		$data = [];
		$data["winget_content_as"] = $this->input->post("winget_content_as");
		$data["winget_name"] = $this->input->post("winget_name");
		$data["winget_icon"] = $this->input->post("winget_icon");
		$data["winget_content"] = $this->input->post("winget_content");

		$this->view('blockview',["data" => $data]);
	}


	/*
	Create Email List
	*/

	public function emailnewlaster(){
		if($this->isPost()){
			$this->load->helper('email');
			$email = $this->input->post_get("email");
			
			if (valid_email($email))
			{
				$check = $this->db->get_where("email_list",["email_address" => $email])->num_rows();
				if($check == 0){
					$this->db->insert("email_list",["email_address" => $email, "created" => getDateSQL(), "updated" => getDateSQL(), "validate" => 0, "tags" => "N/A"]);
				}
			        
			}
			return true;
			
		}
		return false;
		
	}
}
