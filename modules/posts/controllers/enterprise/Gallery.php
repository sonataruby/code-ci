<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
use \Sonata\Image_moo;
class Gallery extends Enterprise {

	public function __construct()
	{
	   parent::__construct();
	   $this->load->helper(['directory','file']);
	}
	public function index()
	{
		return $this->gallery();
	}

	/*
	Gallery
	*/


	public function gallery($id=false){
		
		$data = $this->gallery_model->getListGallery();
		$newImage = $this->gallery_model->getImageList(false,["limit" => 12]);
		$this->view("gallery",["data" => $data, "news" => $newImage]);
	}

	public function delete($gid=false){
		$this->gallery_model->getRemoveGallery($gid);
		$this->go("/posts/enterprise/gallery");
	}
	public function create($id=false){
		if($this->isPost()){
			$arv = [];
			$arv["gallery_name"] = $this->input->post("gallery_name");
			$arv["tags"] = $this->input->post("tags");
			
			$id = $this->gallery_model->create_gallery($id, $arv);
			$this->toJson(["id" => $id]);
			exit();
		}
	}
	public function gimage($gid=false){
		$data = $this->gallery_model->getInfoGallery(false, $gid);
		$this->view('gallery-image',["data" => $data]);
	}


	/*
	resize Image
	*/
	public function rsizeimage($gid=false, $size=false){
		if(!$gid || !$size) $this->go("posts/enterprise/gallery/gimage/{$gid}");
		$image = new Image_moo;
		$arv = $this->gallery_model->getImageList($gid);
		list($w, $h) = explode('x', $size);
		foreach ($arv as $key => $value) {
			$full_path = FCPATH . $value->image_url;
			$new_path = str_replace(basename($full_path), $size."@".basename($full_path), $full_path);
			$image->load($full_path)
			->resize_crop($w,$h)
			->save($full_path, true);
			
		}
		$this->go("posts/enterprise/gallery/gimage/{$gid}");
		
	}



	public function vimage($path=false,$gid=false){
		if($gid) $path = $path."/{$gid}/";
		$path = UPLOAD_PATH . "image/{$path}";
		$url = str_replace(FCPATH, '', $path);
		if($this->input->get("remove")){
			$link = $path . $this->input->get("remove");
			if(file_exists($link)){
				unlink($link);
				$this->gallery_model->remove(sha1($url . $this->input->get("remove")));
			}

			exit();
		}
		$data = directory_map($path, true);
		if(!$data) return "";
		
		
		$i=1;
		foreach ($data as $key => $value) {
			if(strpos($value,'@') === false){
				
				$arvInput = [
					"image_name" => $value,
					"image_url" => $url . $value,
					"image_hash" => sha1($url . $value),
					"image_sorts" => $i,
					"gallery_id" => $gid
				];
				$this->gallery_model->syncImage($arvInput);
				$i++;
			}
		}
		$arv = $this->gallery_model->getImageList($gid);

		$this->view('gallery-item',["data" => $arv]);
	}




	public function sortimage(){
		$data = $this->input->post("item");
		$i = 1;
		foreach ($data as $value) {
		    $this->gallery_model->sorts($i, $value);
		    $i++;
		}
	}
}