<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Sonata\Plugins;

class Video_pi extends Plugins
{
	
	public function data($arv=[], $content=""){
		preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $content, $matches);
		$videoid = $matches[1];
		$arv = $arv + ["video_id" => $videoid];
		return $this->view("video", $arv);
	}

	public function controller($arv=[]){
		return $this->view("video", $arv);
	}
}