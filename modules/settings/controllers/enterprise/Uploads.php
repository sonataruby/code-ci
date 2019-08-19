<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Uploads extends Enterprise {

	public function __construct()
	{
	    parent::__construct();
	    $this->load->helper(['directory','file']);
	}

	public function image($path=false, $gid=false){
		if($gid) $path = $path ."/".$gid."/";
		if(!is_dir(UPLOAD_PATH . "image/{$path}")){
			@mkdir(UPLOAD_PATH . "image/{$path}", 0777, true);
		}

		$config['upload_path']          = UPLOAD_PATH . "image/{$path}";
		$config['allowed_types']        = 'gif|jpg|png';
		//$config['max_size']             = 8000;
		//$config['max_width']            = 1024;
		//$config['max_height']           = 768;

		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('userfile'))
		{
			print_r($this->upload->display_errors());
		}
		else
		{
			$data = $this->upload->data();
			$image = str_replace(FCPATH,'',$data["full_path"]);
			echo stripslashes(json_encode(["link" => site_url($image)]));
		}
	}

	public function imagemanager($return=false){
		$path = directory_map(UPLOAD_PATH . "image/");
		$arv = [];
		foreach ($path as $key => $value) {
			$src = site_url(str_replace(FCPATH,'',UPLOAD_PATH . "image/{$value}"));
			$arv[] = [
				"url" => $src,
				"thumb" => $src,
				"name" => $value,
				"tag" => $value,
				"id" => $value
			];
		}
		if($return) return $arv;
		$this->tojson($arv);
	}

	public function imageremove(){

	}

	public function imagecode(){
		$data = $this->imagemanager(true);
		$arv[] = '<div class="row">';
		foreach ($data as $key => $value) {
			$arv[] = '<div class="col-lg-4 mb-2"><img data-item="image" data-append="'.$value["url"].'" src="'.$value["url"].'" class="w-100 border" style="max-height:100px;"></div>';
		}
		$arv[] = '</div>';
		print_r(implode($arv, "\n"));
	}
}