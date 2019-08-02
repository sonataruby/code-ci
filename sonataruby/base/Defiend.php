<?php
define("CMS_ROOTPATH",str_replace('base','',__DIR__));
define("CMS_BASEPATH",CMS_ROOTPATH . "base" . DIRECTORY_SEPARATOR);
define("CMS_HMVCPATH",CMS_ROOTPATH . "third_party" . DIRECTORY_SEPARATOR . "MX". DIRECTORY_SEPARATOR);
define("CMS_MODULESPATH",[FCPATH . "modules" . DIRECTORY_SEPARATOR => '../../modules/']);
define("CMS_SHAREPATH",CMS_ROOTPATH . "libs" . DIRECTORY_SEPARATOR);
define("CMS_THEMEPATH",FCPATH . "template" . DIRECTORY_SEPARATOR);
define("CMS_THEME_ENTERPRISE_PATH",CMS_ROOTPATH . "template/enterprise/" . DIRECTORY_SEPARATOR);
define("CMS_THEME_PERSONAL_PATH",CMS_ROOTPATH . "template/personal/" . DIRECTORY_SEPARATOR);
define("UPLOAD_PATH", FCPATH . DIRECTORY_SEPARATOR . "upload" . DIRECTORY_SEPARATOR);

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
		if(defined("LOGIN_ID")){
			return LOGIN_ID;
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
