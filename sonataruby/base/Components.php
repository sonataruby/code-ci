<?php
namespace Sonata;
defined('BASEPATH') OR exit('No direct script access allowed');

use Exception;
use stdClass;

class Components {
	function __construct()
	{
		$this->CI =& get_instance();
        $register = isset($this->CI->registerComponents) ? (array)$this->CI->registerComponents : [];
        foreach ($register as $key => $value) {
            $this->{$key} = call_user_func_array($value, []);
        }
	}
	public function comments($key, $url){
        $data = $this->CI->db->get_where("comments")->result();
        return $this->CI->load->view("components/comments",["data" => $data]);
    }

    public function breadcrumb(){
       $data = [];
       $active = "";
    	if(isset($this->CI->load->_ci_cached_vars["data"]->catalog)){
    		$data = $this->CI->load->_ci_cached_vars["data"]->catalog;
    	}
    	if(isset($this->CI->load->_ci_cached_vars["data"]->name)){
    		$active = $this->CI->load->_ci_cached_vars["data"]->name;
    	}

        if(isset($this->CI->load->_ci_cached_vars["data"]->catalog_name)){
            $data[] = json_decode('{"catalog_name" : "Category", "catalog_url" : "'.$this->CI->load->_ci_cached_vars["data"]->catalog_url.'"}');
            $active = $this->CI->load->_ci_cached_vars["data"]->catalog_name;
        }

        
        if(isset($this->CI->load->_ci_cached_vars["data"]->posts)){
            //$data[] = json_decode('{"catalog_name" : "Category", "catalog_url" : "'.$this->CI->load->_ci_cached_vars["data"]->catalog_url.'"}');
            $active = "All Posts";
        }
    	return $this->CI->load->view("components/breadcrumb",["data" => $data, "active" => $active]);
    }



    /*Image */

    public function image($data="", $attr=["class" => "d-block w-100 no-radius"]){
        $data = isObject($data);
        return $this->CI->load->view("components/image",["data" => $data, "attr" => $attr]);
    }

    /*Video */

    public function video($data="", $attr=["class" => "d-block w-100 no-radius"]){
        $data = isObject($data);
        return $this->CI->load->view("components/video",["data" => $data, "attr" => $attr]);
    }

    /*Header */

    public function header($data=[], $attr=["class" => "header fixed-top"]){
        $data = isObject($data);
        //$catalog = $this->CI->catalog_model->getList();
        //$pages = $this->CI->pages_model->getList();
        
        $menu = $this->CI->menu_model->getDropdown();
        $data = array_merge($data, ["menu" => $menu]);
        return $this->CI->load->view("components/header",["data" => $data, "attr" => $attr, "usermenu" => $this->usermenu()]);
    }

    /*Footer*/
    public function footer($data="", $attr=["class" => "footer"]){
        $data = isObject($data);
        return $this->CI->load->view("components/footer",["data" => $data, "attr" => $attr]);
    }

    /*Video */

    public function countdown($data="", $attr=["class" => "d-block w-100 no-radius"]){
        $data = isObject($data);
        return $this->CI->load->view("components/countdown",["data" => $data, "attr" => $attr]);
    }

    /*
        SVG HTML DESIGN
    */

    public function svg($data="", $attr=["class" => "footer"]){
        $data = isObject($data);
        return $this->CI->load->view("components/svg",["data" => $data, "attr" => $attr]);
    }


    public function usermenu(){
        $data = get_instance()->session->userdata("logininfo");
        $arv = '';
        $arv .= '<li class="dropdown-item">Profile</li>';
        $arv .= '<li class="dropdown-item">Change Password</li>';

        if($data->account_type == "enterprise"){
            $arv .= '<li class="dropdown-item"><a href="/enterprise">Administrator</a></li>';
        }

        if($data->account_type == "personal"){
            $arv .= '<li class="dropdown-item"><a href="/personal">Administrator</a></li>';
        }

        $arv .= '<li class="dropdown-item"><a href="/account/logout"><i class="fa fa-lock"></i> Logout</a></li>';
        return $arv;
    }
}