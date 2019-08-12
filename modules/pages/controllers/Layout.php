<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise as CPEnterprise;
use \Sonata\Image;
class Layout extends CPEnterprise {

	
	public function index()
	{
		$this->view('welcome_message');
	}

	public function create($id=false){
		$image = new Image;
		$data = $this->layout_model->getData(false, $id);
		
		if($this->isPost()){
			$arv = [
				"layout_name" => $this->input->post("layout_name"),
				"layout_description" => $this->input->post("layout_description"),
				"layout_image" =>  $image->saveImageUpload($this->input->post("layout_image"),"image",@$data->image),
				"layout_keyword" => $this->input->post("layout_keyword"),
				"layout_url" => $this->input->post("layout_url"),
				"layout_content" => $this->clearContent($this->input->post("content")),
				"language" => $this->config->item("language")
			];
			$id = $this->layout_model->create($id, $arv);
			$this->go("/pages/layout/create/{$id}");
		}
		
		$this->view('layout-create',["data" => $data]);
	}


	
}