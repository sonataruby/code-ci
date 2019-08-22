<?php
use Sonata\Controller;
class Breadcrumb extends Controller{
	function __construct()
	{
		
		$this->load->registerView( __DIR__ );
		
		//$this->main($arv, $arv2);
	}

	public function main($type, $arv=[]){
		$type = ($type && $type !== "breadcrumb" ? "-{$type}" : "");

		$data = [];
       $active = "";
       if($arv["active"]) $active = $arv["active"];

        if(isset($this->load->_ci_cached_vars["data"]->channel) && $this->load->_ci_cached_vars["data"]->channel){
            $data[] = json_decode('{"catalog_name" : "'.config_item("channel")->{$this->load->_ci_cached_vars["data"]->channel}->name.'", "catalog_url" : "post"}');
        }
    	if(isset($this->load->_ci_cached_vars["data"]->catalog)){
    		$data = array_merge($data,$this->load->_ci_cached_vars["data"]->catalog);
    	}
    	if(isset($this->load->_ci_cached_vars["data"]->name)){
    		$active = $this->load->_ci_cached_vars["data"]->name;
    	}

        if(isset($this->load->_ci_cached_vars["data"]->catalog_name)){
            $data[] = json_decode('{"catalog_name" : "{lang_category}", "catalog_url" : "'.$this->load->_ci_cached_vars["data"]->catalog_url.'"}');
            $active = $this->load->_ci_cached_vars["data"]->catalog_name;
        }

       
        if(isset($this->load->_ci_cached_vars["data"]->posts)){
            //$data[] = json_decode('{"catalog_name" : "Category", "catalog_url" : "'.$this->CI->load->_ci_cached_vars["data"]->catalog_url.'"}');
            $active = "All Posts";
        }

		return $this->load->view("components/breadcrumb{$type}",["attr" => $arv, "data" => $data, "active" => $active]);
	}


}