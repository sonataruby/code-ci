<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Sonata\Plugins;

class Video_pi extends Plugins
{
	
	public function data($arv=[], $content=""){
		$arv["type"] = (!isset($arv["type"]) ? "video" : $arv["type"]);
		if(@$arv["type"] == "background"){
			preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", @$arv["url"], $matches);
			$videoid = @$matches[1];
			
		}else{
			preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $content, $matches);
			$videoid = @$matches[1];
		}
		$arv = $arv + ["video_id" => $videoid, "content" => $content];

		return $this->view("video", $arv);
	}

	public function controller($arv=[]){
		return $this->view("video", $arv);
	}
}