<?php  
namespace Sonata;
use Exception;
use stdClass;
include BASEPATH . "libraries/image_lib.php";
class Image extends \CI_Image_lib{
	function __construct()
	{
		parent::__construct();
	}

	public function setImage($arv, $path="", $oldImg=[], $name=""){
		if(!is_array($arv) || !$path) return false;

		if(!is_dir(COMPANY_PATH . $path)){
			mkdir(COMPANY_PATH . $path, 0775, true);
		}
		$file = [];

		foreach ($arv as $key => $value) {
			if(trim($value)){
				$pos = strpos($value, 'base64');
				if ($pos !== false) {
					if(@file_exists(FCPATH . $oldImg[$key])){
						@unlink(FCPATH . $oldImg[$key]);
					}
					$file[] = $this->base64ToImage($value, COMPANY_PATH . $path, $name);
				}else{
					$file[] = $value;
				}
			}
			
		}
		if(is_array($oldImg)){
			foreach ($oldImg as $key => $value) {
				if(!in_array($value, $file)){
					if(@file_exists(FCPATH . $value)){
						@unlink(FCPATH . $value);
					}
				}
			}
		}

		$files = [];
		foreach ($file as $key => $value) {
			$files[] = str_replace(FCPATH, '', $value);
		}
		return $files;

	}


	public function saveImageUpload($data, $path="", $oldImg=[], $name=""){
		if(empty($data)) return "";
		if(!is_dir(UPLOAD_PATH . $path)){
			mkdir(UPLOAD_PATH . $path, 0775, true);
		}

		$file = [];

		foreach ($data as $key => $value) {
			if(trim($value)){
				$pos = strpos($value, 'base64');
				if ($pos !== false) {
					if(@file_exists(FCPATH . $oldImg[$key])){
						@unlink(FCPATH . $oldImg[$key]);
					}
					$file[] = $this->base64ToImage($value, UPLOAD_PATH . $path, $name);
				}else{
					$file[] = $value;
				}
			}
			
		}

		if(is_array($oldImg)){
			foreach ($oldImg as $key => $value) {
				if(!in_array($value, $file)){
					if(@file_exists(FCPATH . $value)){
						@unlink(FCPATH . $value);
					}
				}
			}
		}

		$files = [];
		foreach ($file as $key => $value) {
			$files[] = str_replace(FCPATH, '', $value);
		}
		if(count($files) > 1){
			return json_encode($files);
		}else{
			return (isset($files[0]) ? $files[0] : "");
		}
		


	}
	private function base64ToImage($imageData, $path="", $name=false){
		if(!$imageData) return false;
	    list($type, $imageData) = explode(';', $imageData);
	    list(,$extension) = explode('/',$type);
	    list(,$imageData)      = explode(',', $imageData);
	    if($name){
	    	$fileName = $path. "/" .$name.'.'.$extension;
	    }else{
	    	$fileName = $path. "/" .uniqid().'.'.$extension;
	    }
	    
	    $imageData = base64_decode($imageData);
	    file_put_contents($fileName, $imageData);
	    return $fileName;
	}

}