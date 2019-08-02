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
		$data = $this->pages_model->getData(false, $id);
		
		if($this->isPost()){
			$arv = [
				"page_name" => $this->input->post("page_name"),
				"page_description" => $this->input->post("page_description"),
				"page_keyword" => $this->input->post("page_keyword"),
				"page_layout" => $this->input->post("page_layout"),
				"page_url" => $this->input->post("page_url"),
				"page_content" => $this->clearContent($this->input->post("content")),
				"page_icoin" => $this->input->post("page_icoin"),
				"page_tag" => $this->input->post("page_tag"),
				"page_image" => $image->saveImageUpload($this->input->post("page_image"), "image",@$data->page_image),
				"language" => $this->config->item("language")
			];
			$id = $this->pages_model->create($id, $arv);
			$this->go("/pages/layout/create/{$id}");
		}

		$data = [];
		$settemplate = CMS_THEMEPATH . TEMPLATE_ACTIVE . DIRECTORY_SEPARATOR . "layout" . DIRECTORY_SEPARATOR;
		
		$this->view($this->get_views('layout-create'),["data" => $data]);
	}
}