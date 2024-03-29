<?php
namespace Sonata;
defined('BASEPATH') OR exit('No direct script access allowed');

use Exception;
use stdClass;

class Components {
	function __construct()
	{
		$this->CI =& get_instance();
       
	}

    
	public function comments($key, $url){
        $data = $this->CI->db->get_where("comments")->result();
        return $this->CI->load->view("components/comments",["data" => $data]);
    }

  



    /*Image 

    public function image($data="", $attr=["class" => "d-block w-100 no-radius"]){
        $data = isObject($data);
        return $this->CI->load->view("components/image",["data" => $data, "attr" => $attr]);
    }
    */
    /*Video */

    public function video($data="", $attr=["class" => "d-block w-100 no-radius"]){
        $data = isObject($data);
        return $this->CI->load->view("components/video",["data" => $data, "attr" => $attr]);
    }


    /*Video */

    public function gallery($data="", $attr=[]){
        $arv = url_toarray($data);
        $gid = false;
        if(isset($arv["gid"]) && intval($arv["gid"]) > 0){
            $gid = $arv["gid"];
        }
        if(isset($arv["tags"])){
            
            $data = @$this->CI->gallery_model->getInfoGallery(false, false, $arv)->image;
            if(!$data) $data = [];
        }else{
            $data = $this->CI->gallery_model->getImageList($gid, $arv);
        }
        $link = @explode('|', $arv["link"]);
        

        return $this->CI->load->view("components/gallery",["data" => $data, "attr" => $attr, "link" => $link]);
    }

    

    /*Video */ 

    public function countdown($data="", $attr=["class" => "d-block w-100 no-radius"]){
        $data = isObject($data);
        return $this->CI->load->view("components/countdown",["data" => $data, "attr" => $attr]);
    }

    public function contact($data="", $attr=["class" => "footer"]){
        $data = isObject($data);
        return $this->CI->load->view("components/contact",["data" => $data, "attr" => $attr]);
    }


    public function booking($data="", $attr=["class" => "footer"]){
        $data = isObject($data);
        return $this->CI->load->view("components/booking",["data" => $data, "attr" => $attr]);
    }

    /*
        SVG HTML DESIGN
    */

    public function svg($data="", $attr=["class" => "footer"]){
        $data = isObject($data);
        return $this->CI->load->view("components/svg",["data" => $data, "attr" => $attr]);
    }


   

    

    /*
    User Profile
    */
   




    public function getItems($items, $arvs=[], $arvs2=[]){
        $classname = ucfirst($items);

        if(isset($this->{$items})) $this->{$items};

        if(class_exists($classname)){
           $this->{$items} = new $classname;
           return $this->{$items}->main($arvs, $arvs2);
        }

        $arv = [
                CMS_THEMEPATH . TEMPLATE_ACTIVE . DIRECTORY_SEPARATOR . "apps". DIRECTORY_SEPARATOR ."components" . DIRECTORY_SEPARATOR, 
                COMPONENTS_LOCAL
        ];

        foreach ($arv as $key => $value) {
            $path = $value . "{$items}/".ucfirst($items).".php";

            if(file_exists($path) && !isset($this->{$items})){
                
                if(!defined("IS_FRONTEND")) define("IS_FRONTEND", true);
                if(!class_exists($classname)){
                    include $path;
                    if(class_exists($classname)){
                        $this->{$items} = new $classname;
                        return $this->{$items}->main($arvs, $arvs2);
                    }
                    return false;
                }
            }
        }
        
        return false;
    }

    public function __call($method, $parameters)
    {
        if(!isset($this->{$method})){
            /*Register Method*/
            return $this->getItems($method, @$parameters[0],@$parameters[1]);
            //return $this->{$method};
        }else{
            return $this->{$method}->main(@$parameters[0],@$parameters[1]);
        }
    }

}