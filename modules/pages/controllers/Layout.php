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
		$this->load->helper('directory');
		$dir = directory_map(CMS_THEMEPATH . TEMPLATE_ACTIVE . "/layout/",true);
		if($this->isPost()){
			$arv = [
				"layout_name" => $this->input->post("layout_name"),
				"layout_description" => $this->input->post("layout_description"),
				"layout_image" =>  $image->saveImageUpload($this->input->post("layout_image"),"image",@$data->image),
				"layout_keyword" => $this->input->post("layout_keyword"),
				"layout_url" => $this->input->post("layout_url"),
				"layout_content" => $this->clearContent($this->input->post("content"))
			];
			$id = $this->layout_model->create($id, $arv);
			$this->go("/pages/layout/create/{$id}");
		}
		if($this->input->get("loadding") && file_exists(CMS_THEMEPATH . TEMPLATE_ACTIVE . "/layout/".$this->input->get("loadding"))){
			$data->content = file_get_contents(CMS_THEMEPATH . TEMPLATE_ACTIVE . "/layout/".$this->input->get("loadding"));
		}
		
		$this->view('layout-create',["data" => $data, "layout" => $dir]);
	}

	public function plugins(){
		$plugins = $this->input->get("controller");
		print_r($plugins);
	}
	


	public function builder($page_id){
		if($this->isPost()){
			$content = $this->input->post("content");
			$content = trim($this->renderContent($content));
			$this->layout_model->updatecontent($page_id, ["layout_content" => $content]);
			exit();
		}
		return $this->view("layout-builder", ["page_id" =>$page_id, "server_api" => $this->server_api_url]);
	}

	public function loadcontent($page_id){
		
		$data = $this->layout_model->getData(false, $page_id);
		$data->content = $this->builderContent($data->content);
		$this->setLayout("_bank.php");
		$this->allowAjax = false;
		return $this->view("layout-content",["data" => $data]);
		
	}

	private function renderContent($text){
		return str_replace(['<components>','</components>'], '', $text);
		preg_match_all(
                '#'.preg_quote('<div').' title="(.+?)"'.preg_quote('}').'(.+?)'.preg_quote('{/components}').'#s',
                $text,
                $matches,
                PREG_SET_ORDER
            );
            $search = [];
            $replace = [];
           foreach ($matches as $key => $value) {
           		list($source, $name, $options) = @$value;
           		$search[] = $source;
           		$replace[] = '<div title="'.$source.'" data-toggle="modal" data-target="#ModalComponents">Components '.$name.'</div>';
           }
        $text = str_replace($search, $replace, $text);
        return $text;
	}

	private function builderContent($text){
		
		preg_match_all(
                '#'.preg_quote('{').'components=(.+?)'.preg_quote('}').'(.+?)'.preg_quote('{/components}').'#s',
                $text,
                $matches,
                PREG_SET_ORDER
            );
            $search = [];
            $replace = [];
           foreach ($matches as $key => $value) {
           		list($source, $name, $options) = @$value;
           		$search[] = $source;
           		$replace[] = '<components data-content="'.$source.'">'.$this->renderComponents($source).'</components>';
           }
        $text = str_replace($search, $replace, $text);
        return $text;
	}
	public function renderComponents($source){
		return $source;
	}
}