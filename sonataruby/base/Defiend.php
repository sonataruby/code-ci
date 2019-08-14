<?php
define("CMS_ROOTPATH",str_replace('base','',__DIR__));
define("CMS_BASEPATH",CMS_ROOTPATH . "base" . DIRECTORY_SEPARATOR);
define("CMS_HMVCPATH",CMS_ROOTPATH . "third_party" . DIRECTORY_SEPARATOR . "MX". DIRECTORY_SEPARATOR);
define("CMS_MODULESPATH",[FCPATH . "modules" . DIRECTORY_SEPARATOR => '../../modules/']);
define("CMS_SHAREPATH",CMS_ROOTPATH . "libs" . DIRECTORY_SEPARATOR);
define("CMS_THEMEPATH",FCPATH . "template" . DIRECTORY_SEPARATOR);
define("CMS_THEME_ENTERPRISE_PATH",CMS_ROOTPATH . "template/enterprise" . DIRECTORY_SEPARATOR);
define("CMS_THEME_PERSONAL_PATH",CMS_ROOTPATH . "template/personal" . DIRECTORY_SEPARATOR);
define("UPLOAD_PATH", FCPATH . DIRECTORY_SEPARATOR . "upload" . DIRECTORY_SEPARATOR);
define("CONFIG_LOCAL", FCPATH . DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR);
define("CACHE_LOCAL", FCPATH . DIRECTORY_SEPARATOR . "cache" . DIRECTORY_SEPARATOR);

if(!function_exists("autoload_file")){
	function autoload_file($path=""){
		if(defined("BASE_ENTERPRISE")){
            $spath = CMS_THEME_ENTERPRISE_PATH . $path;
            if(file_exists($spath)){
            	include_once $spath;
            }
        }
        
        if(defined("BASE_PERSONAL")){
            
            $spath = CMS_THEME_PERSONAL_PATH . $path;
            if(file_exists($spath)){
            	include_once $spath;
            }
            
        }
        if(!defined("TEMPLATE_ACTIVE")) define("TEMPLATE_ACTIVE","default");
        $file = CMS_THEMEPATH . TEMPLATE_ACTIVE . DIRECTORY_SEPARATOR . $path;
        if(file_exists($file)){
        	include_once $file;
        }
        
	}
	
		

		$base_url  = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on')) ?  "https" : "http";
        $base_url .= "://".$_SERVER['HTTP_HOST'];
        $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
        $base_url = str_replace(['http://','https://','www.','/'],'',$base_url);
		$base_url = strtolower($base_url);
		if(!defined("DOMAIN")){
			define("DOMAIN", $base_url);
			define("BASE_URL", ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on')) ?  "https" . "://".$base_url : "http" . "://".$base_url);
		}

		
		if(file_exists(CONFIG_LOCAL . $base_url.".json")){
			$json = json_decode(file_get_contents(CONFIG_LOCAL . $base_url.".json"));

			if(!defined("TEMPLATE_ACTIVE")){
				define("TEMPLATE_ACTIVE", (@$json->template ? @$json->template : "default"));
			}
		}
	autoload_file("function.php");
}

if(!function_exists("template_url")){
	function template_url($path="", $arv=[]){
		if(!$path) return site_url();
		$file = local_file($path);

		$vpath = str_replace(FCPATH, '', $file);
		if(file_exists($file)){

			$url = site_url($vpath);
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			if($ext == "css"){
				echo '<link rel="stylesheet" href="'.$url.'" '._stringify_attributes($arv).'/>';
			}else if($ext == "js"){
				echo '<script src="'.$url.'" '._stringify_attributes($arv).'/></script>';
			}else{
				return $url;
			}
		}
		return false;

	}
}

if(!function_exists("local_file")){
	function local_file($path=""){
		if(defined("BASE_ENTERPRISE")){
            return CMS_THEME_ENTERPRISE_PATH . $path;
            
        }
        
        if(defined("BASE_PERSONAL")){
            
            return CMS_THEME_PERSONAL_PATH . $path;
            
        }
        $file = CMS_THEMEPATH . TEMPLATE_ACTIVE . DIRECTORY_SEPARATOR . $path;
        return $file;
	}
}

if(!function_exists("libs_url")){
	function libs_url($path="", $arv=[]){
		
		$file = FCPATH . "libs" . DIRECTORY_SEPARATOR . $path;
		
		if(file_exists($file)){
			$url = site_url("libs/{$path}");
			$ext = pathinfo($file, PATHINFO_EXTENSION);
			if($ext == "css"){
				echo '<link rel="stylesheet" href="'.$url.'" '._stringify_attributes($arv).'/>';
			}else if($ext == "js"){
				echo '<script src="'.$url.'" '._stringify_attributes($arv).'/></script>';
			}else{
				return $url;
			}
		}
		return false;

	}
}

if(!function_exists("getfile")){
	function getfile($file){
		$file = local_file($file);
		if(file_exists($file)){
			$CI =& get_instance();
			include $file;
		}
	}
}


if(!function_exists("is_home")){
	function is_home()
	{
	   $CI =& get_instance();
	   return (!$CI->uri->segment(1))? TRUE: FALSE;
	}
}

if(!function_exists("is_login")){
	function is_login(){
		$data = get_instance()->session->userdata("logininfo");
		if(!$data) return false;
		if($data->account_id){
			return true;
		}
		return false;
	}
}

if(!function_exists("is_ajax")){
	function is_ajax(){
		return get_instance()->input->is_ajax_request();
	}
}


if(!function_exists("image_raito")){
	function image_raito($raito="1:1:true",$size=["990","440"]){
		@list($maxWidth,$maxHeight) = $size;
		@list($rs,$rn,$rt) = explode(':',trim($raito));

		$srcWidth = (int)(($rs / $rn) * $maxWidth);
		$srcHeight = (int)(($rs / $rn) * $maxHeight);
		if($rt === "true"){
			return $srcWidth."x".$srcHeight;
		}
		return ["width" => $srcWidth, "height" => $srcHeight];
		
	}
}


if(!function_exists("addon")){
	function addon($file="", $arv=[]){
		if(!$file) return;
		return get_instance()->load->view($file, $arv);
	}
}


if(!function_exists("post_api")){
	function post_api($uri="", $arv=[]){
		if(!$uri) return;
		return get_instance()->postAPI($uri, $arv);
	}
}

if(!function_exists("get_api")){
	function get_api($uri="", $arv=[]){
		if(!$uri) return;
		return get_instance()->getAPI($uri, $arv);
	}
}


if(!function_exists("put_api")){
	function put_api($uri="", $arv=[]){
		if(!$uri) return;
		return get_instance()->putAPI($uri, $arv);
	}
}

if(!function_exists("patch_api")){
	function patch_api($uri="", $arv=[]){
		if(!$uri) return;
		return get_instance()->patchAPI($uri, $arv);
	}
}

if(!function_exists("delete_api")){
	function delete_api($uri="", $arv=[]){
		if(!$uri) return;
		return get_instance()->deleteAPI($uri, $arv);
	}
}



if ( ! function_exists('lang'))
{
	
	function lang($line, $for = false, $attributes = array())
	{
		$extract = explode('.', $line);
		if(count($extract) > 1){
			$line = @get_instance()->lang->line($extract[0])[$extract[1]];

		}else{
			$line = get_instance()->lang->line($line);
		}
		


		if ($for && !$line)
		{
			$line = isset($extract[1]) ? ucfirst($extract[1]) : ucfirst($extract[0]);
			$line = str_replace('_', " ", $line);
		}

		return $line;
	}
}


if ( ! function_exists('form_textarea'))
{
	function form_textarea($data = '', $value = '', $extra = '')
	{
		$defaults = array(
			'name' => is_array($data) ? '' : $data,
			'cols' => !isset($extra['cols']) ? '40' : $extra['cols'],
			'rows' => !isset($extra['rows']) ? '10' : $extra['rows']
		);

		if ( ! is_array($data) OR ! isset($data['value']))
		{
			$val = $value;
		}
		else
		{
			$val = $data['value'];
			unset($data['value']); // textareas don't use the value attribute
		}

		return '<textarea '._parse_form_attributes($data, $defaults)._attributes_to_string($extra).'>'
			.html_escape($val)
			."</textarea>\n";
	}
}

if(! function_exists("isObject")){
	function isObject($text="", $debug=false){
		if(is_object($text) || is_array($text)) return $text;
		if(empty($text)) return "";

		$decode = json_decode($text);
		if (is_object($decode) || is_array($decode)){
			
			$text = ($decode ? $decode : []);

			
		}
		if($debug){
			print_r($text);
		}
		return $text;
	}
}

if(! function_exists("getDateSQL")){
	function getDateSQL($date=false, $conver=false){
		if(!$conver){
			return date("Y-m-d h:i:s");
		}
	}
}

if( ! function_exists("post_url")){
	function post_url($url){
		return site_url("post/{$url}.html");
	}
}

if( ! function_exists("catalog_url")){
	function catalog_url($url){
		return site_url("catalog/{$url}.html");
	}
}


if( ! function_exists("page_url")){
	function page_url($url){
		return site_url("page/{$url}.html");
	}
}


