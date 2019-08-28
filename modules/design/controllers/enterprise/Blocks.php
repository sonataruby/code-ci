<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise as CPEnterprise;
use \Sonata\Image;
class Blocks extends CPEnterprise {

	public function __construct()
	{
	    parent::__construct();
	   
	}
	public function index()
	{
		return $this->manager();
	}

	public function manager(){
		$data = $this->db->get("design_blocks")->result();
		$this->view("blocks-manager",["data" => $data]);
	}

	public function create($id=false){
		$data = $this->db->get_where("design_blocks",["block_id" => $id])->row();
		if($this->isPost()){
			$image = new Image;
			$arv = [
				"block_name" => $this->input->post("block_name"),
				"block_content" => $this->input->post("block_content"),
				"block_keyword" => $this->input->post("block_keyword"),
				"block_image" => $image->saveImageUpload($this->input->post("block_image"), "blocks",@$data->block_image),
			];
			if(!isset($data->block_id)){
				$this->db->insert("design_blocks", $arv);
			}else{
				$this->db->update("design_blocks", $arv, ["block_id" => $data->block_id]);
			}
			$this->go("design/enterprise/blocks");
		}
		$this->view("blocks-create",["data" => $data]);
	}
}