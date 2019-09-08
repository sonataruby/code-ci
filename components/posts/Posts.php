<?php
use Sonata\Controller;
class Posts extends Controller{
	function __construct()
	{
		
		$this->load->registerView( __DIR__ );
		
		//$this->main($arv, $arv2);
	}

	public function main($type=false, $attr=[]){
		$page = "";
		$theme = (@$attr["theme"] && file_exists(__DIR__ ."/components/posts-{$attr["theme"]}.php") ? "-{$attr["theme"]}" : "");
		if($type) $attr["channel"] = $type;
		if(isset($attr["page"]) || isset($attr["pages"])) $attr["pages"] = true;

		$data = $this->posts_model->getList($attr);
		
		if(@$attr["pages"])$page = $this->posts_model->pages();
		return $this->load->view("components/posts{$theme}",["attr" => $attr, "data" => $data, "pages" => $page]);
	}


}