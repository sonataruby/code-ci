<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Tools extends Enterprise {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(['directory','file']);
	}

	public function index(){
		return $this->view("tools");
	}


	public function templates($template=false){
		$template = ($template ? $template : TEMPLATE_ACTIVE);
		$themePath = CMS_THEMEPATH . $template . DIRECTORY_SEPARATOR  ."components" . DIRECTORY_SEPARATOR;

		if($this->input->get("copy")){
			$source = FCPATH . $this->input->get("copy");
			if(file_exists($source)){
				$saveFile = $themePath . basename($this->input->get("copy"));
				write_file($saveFile, read_file($source));
				$this->go("tools/templates/{$template}");
			}
		}

		if($this->input->get("channel")){
			$source_path = array_keys(array_slice(CMS_MODULESPATH, 0, 1))[0] . "posts/views/";
			$source = $source_path . "channel/". $this->input->get("channel") ;
			
			if(is_dir($source)){
				$file = glob($source."/*.php");
			}else{
				$file = glob($source_path."*.php");
			}

			/*
			Check Templates
			*/
			$themePath = str_replace('components', 'channel', $themePath);
			if(!is_dir($themePath .$this->input->get("channel"))){
				mkdir($themePath . $this->input->get("channel"), 0777, true);
			}
			foreach ($file as $key => $value) {

				write_file($themePath . $this->input->get("channel")."/".basename($value), read_file($value));
				
			}
			$this->go("tools/templates/{$template}");
			//print_r($source);
			
		}

		if($this->input->get("layout")){
			$themePath = str_replace('components', 'layout', $themePath);
			if(!is_dir($themePath)){
				mkdir($themePath, 0777, true);
			}
			write_file($themePath . $this->input->get("layout"), read_file(CMS_SHAREPATH . "layout/".$this->input->get("layout")));
			$this->go("tools/templates/{$template}");
		}

		if($this->input->get("fixmiss")){
			$themePath = str_replace('components/', '', $themePath);
			foreach ($this->input->get("fixmiss") as $key => $value) {
				if(!file_exists($themePath . $value)){
					write_file($themePath . $value, "");
				}
			}
			$this->go("tools/templates/{$template}");
		}

        $components = glob(COMPONENTS_LOCAL."*/components/*.php");
        $theme = directory_map(CMS_THEMEPATH, true);
       
		return $this->view("templates",["components" => $components, "themePath" => $themePath, "theme" => $theme, "active" => $template]);
	}
}