<?php
use Sonata\Controller;
class Slider extends Controller{
	function __construct()
	{
		
		$this->load->registerView( __DIR__ );
		
		//$this->main($arv, $arv2);
	}

	public function main($type, $attr=[]){
		$type = ($type ? "-{$type}" : "");
		@list($lib,$channel,$limit) = explode('-', $attr["data"]);
		
		if($lib && $channel && $limit && @$attr["libs"] == "data"){
			$data = $this->getAPI("/posts/api/list/{$channel}",["limit" => $limit]);
			$attr["data"] = $data->data;
			$attr["server"] = $data->server;
		}else{
			if($attr["data"] && @$attr["libs"] == "text"){
				$extract = explode('|', $attr["data"]);
				$extractNodeArv = [];
				foreach ($extract as $key => $value) {
					$extractNode = explode(';', $value);
					$extractNodeArv[] = [
						"name" => @$extractNode[0],
						"image" => @$extractNode[1],
						"description" => @$extractNode[2],
						"link" => @$extractNode[3],
					];
				}
				$attr["data"] = json_decode(json_encode($extractNodeArv));
				$attr["server"] = "";
			}
			if($attr["data"] && @$attr["libs"] == "json"){
				$attr["data"] = json_decode($attr["data"]);
				$attr["server"] = "";
			}
		}
		
		return $this->load->view("components/slider{$type}",["attr" => $attr]);
	}


}