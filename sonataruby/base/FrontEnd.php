<?php
namespace Sonata;
defined('BASEPATH') OR exit('No direct script access allowed');
use Exception;
use stdClass;
use \Sonata\Controller;

class FrontEnd extends Controller{
	function __construct()
	{
		parent::__construct();
		define("IS_FRONTEND",true);
	}

	public function view($file, $data=[]){
		
		$data_pate = [];
		$data_pate["full_address"] = get_address();
		foreach ($this->lang->language as $key => $value) {
			$data_pate["lang_".$key] = $value;
		}
		
		foreach ($this->settings as $key => $value) {
			$data_pate[$key] = is_object($value) ? (array)$value : $value;
		}
		$data_pate["hotline"] = format_phone(config_item("hotline"));

		if(is_ajax()){
			$dataRender = $this->load->view("{$file}",$data, true);
			$data_pate = [];
			foreach ($this->lang->language as $key => $value) {
				$data_pate["lang_".$key] = $value;
			}
			
			foreach ($this->settings as $key => $value) {
				$data_pate[$key] = is_object($value) ? (array)$value : $value;
			}
			
			$dataRender = $this->minify_html($this->parser->parse_string($dataRender, $data_pate, true));
			print_r($dataRender);
			exit();
		}
		
		$content = $this->load->view("{$file}",$data,true, $this->channelLayout);
		
		

		$dataRender = $this->shortcode->run($this->load->view("layout/".$this->setLayout,["content" => $content, "data" => $data, "header" => $this->header], true));
		$dataRender = $this->minify_html($this->parser->parse_string($dataRender, $data_pate, true));


		print_r($dataRender);
		exit();
	}

	public function minify_html($html)
	{
		
			

	   $search = array(
	    '/(\n|^)(\x20+|\t)/',
	    '/(\n|^)\/\/(.*?)(\n|$)/',
	    '/\n/',
	    '/\<\!--.*?-->/',
	    '/(\x20+|\t)/', # Delete multispace (Without \n)
	    '/\>\s+\</', # strip whitespaces between tags
	    '/(\"|\')\s+\>/', # strip whitespaces between quotation ("') and end tags
	    '/=\s+(\"|\')/'); # strip whitespaces between = "'

	   $replace = array(
	    "\n",
	    "\n",
	    " ",
	    "",
	    " ",
	    "> <",
	    "$1>",
	    "=$1");

		$html = str_replace("\n","",preg_replace($search,$replace,$html));
		return $html;
	}

}
