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
define("CACHE_LOCAL", FCPATH . "cache" . DIRECTORY_SEPARATOR);
define("COMPONENTS_LOCAL", FCPATH . "components" . DIRECTORY_SEPARATOR);

define("CHANNEL_DEFAULT","blogs");

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
		if(@$data->account_id){
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
		if(empty(trim($text))) return "";

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
	function post_url($url, $prefix=""){
		return site_url("{$prefix}/post/{$url}.html");
	}
}

if( ! function_exists("catalog_url")){
	function catalog_url($url, $prefix=""){
		
		if($url == "post"){
			return site_url("{$prefix}/{$url}.html");
		}
		return site_url("{$prefix}/catalog/{$url}.html");
	}
}


if( ! function_exists("page_url")){
	function page_url($url){
		return site_url("page/{$url}.html");
	}
}



if( ! function_exists("get_country")){
	function get_country($code){
		$ci = &get_instance();
		if(!isset($ci->country)){
			$ci->country = json_decode(file_get_contents(__DIR__ . "/../libs/country.json"));
		}
		foreach ($ci->country as $key => $value) {
			if($value->code == $code){
				return $value->name;
			}
		}
	}
}

if( ! function_exists("get_address")){
	function get_address(){
		$arv = [];
		$arv[] = config_item("address");
		if(config_item("address2")){
			$arv[] = config_item("address2");
		}
		if(config_item("city")) $arv[] = config_item("city");
		$arv[] = config_item("region");
		$arv[] = get_country(config_item("country"));
		return implode($arv, ", ");
	}
}

if( ! function_exists("format_phone")){
	function format_phone($number, $country="+"){
		

		$number = sprintf("%s-%s-%s",
	              substr($number, 0, 4),
	              substr($number, 4, 3),
	              substr($number, 7));

		return $number;
	}
}

if( ! function_exists("url_toarray")){
	function url_toarray($data){
		parse_str(str_replace('amp;','',$data), $arv);
		return $arv;
	}
}

function getRef($string=false){
	if(!$string){
		$callback = $_SERVER['QUERY_STRING'];
		$callback = str_replace(['&','&amp;'],'|', $callback);
	}else{
		$callback = $string;
		$callback = str_replace('|','&', $callback);
	}
	
	return $callback;
}




if (! function_exists('vdebug')) {
    function vdebug($data=[], $die = false, $add_var_dump = true, $add_last_query = true)
    {
        $CI = &get_instance();
        $CI->load->library('unit_test');
        $bt = debug_backtrace();
        $src = file($bt[0]["file"]);
        $line = $src[$bt[0]['line'] - 1];
        # Match the function call and the last closing bracket
        preg_match('#' . __FUNCTION__ . '\((.+)\)#', $line, $match);
        $max = strlen($match[1]);
        $varname = null;
        $c = 0;
        for ($i = 0; $i < $max; $i++) {
            if ($match[1]{$i} == "(") {
                $c++;
            } elseif ($match[1]{$i} == ")") {
                $c--;
            }
            if ($c < 0) {
                break;
            }
            $varname .= $match[1]{$i};
        }
        if (is_object($data)) {
            $message = '<span class="vayes-debug-badge vayes-debug-badge-object">OBJECT</span>';
        } elseif (is_array($data)) {
            $message = '<span class="vayes-debug-badge vayes-debug-badge-array">ARRAY</span>';
        } elseif (is_string($data)) {
            $message = '<span class="vayes-debug-badge vayes-debug-badge-string">STRING</span>';
        } elseif (is_int($data)) {
            $message = '<span class="vayes-debug-badge vayes-debug-badge-integer">INTEGER</span>';
        } elseif (is_true($data)) {
            $message = '<span class="vayes-debug-badge vayes-debug-badge-true">TRUE [BOOLEAN]</span>';
        } elseif (is_false($data)) {
            $message = '<span class="vayes-debug-badge vayes-debug-badge-false">FALSE [BOOLEAN]</span>';
        } elseif (is_null($data)) {
            $message = '<span class="vayes-debug-badge vayes-debug-badge-null">NULL</span>';
        } elseif (is_float($data)) {
            $message = '<span class="vayes-debug-badge vayes-debug-badge-float">FLOAT</span>';
        } else {
            $message = 'N/A';
        }
        $output  = '';
       
        $output .= '<div class="debugbody fixed-bottom"><div class="card card-body">';
        $output .= '<h1 class="debugheader">'.$varname.'</h1>';
        $output .= '<div class="debugcontent">';
       
        if ($add_var_dump) {
            $output .= '<code class="debugcode"><p class="debugp debugbold debutextR">:: var_dump</p><pre class="debugpre">';
            ob_start();
            var_dump($data);
            $vardump = trim(ob_get_clean());
            $vardump = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $vardump);
            $output .=  $vardump;
            $output .= '</pre></code>';
        }else{
        	$output .= '<code class="debugcode"><p class="debugp debugbold debutextR">:: print_r</p><pre class="debugpre">'.$message;
	        ob_start();
	        print_r($data);
	        $output .= "\n\n".trim(ob_get_clean());
	        $output .= '</pre></code>';
        }
        if ($add_last_query) {
            if ($CI->db->last_query()) {
                $output .= '<p class="debugp debugbold debutextR lq-trigger">Show Last Query</p>';
                $output .= $CI->db->last_query();
                $output .= '</code>';
            }
        }
        $output .= '</div></div></div>';
        $output .= '<div style="clear:both;"></div>';
        if (PHP_SAPI == 'cli') {
            echo $varname . ' = ' . PHP_EOL . $output . PHP_EOL . PHP_EOL;
            return;
        }
        echo $output;
        if ($die) {
            exit;
        }
    }
}