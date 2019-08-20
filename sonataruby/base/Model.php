<?php
namespace Sonata;
defined('BASEPATH') OR exit('No direct script access allowed');

use Exception;
use stdClass;
use \CI_Model;
class Model extends CI_Model{
	public $limit=20;
	public $total = 0;
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library("pagination");
		
	}
	public function setLimit($limit){
		$this->limit = $limit;
	}
	public function setTotal($total){
		$this->total = $total;
	}
	public function pages($link=false){
		$config['base_url'] = ($link ? $link : current_url());

		$config['total_rows'] = $this->total;

		$config['per_page'] = $this->limit;
		$config['query_string_segment'] = 'page';
		$config['page_query_string'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		
		$config['num_links'] = 5;
		//$config['uri_segment'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<nav aria-label="Page navigation"><ul class="pagination">';
		$config['full_tag_close'] = '</ul></nav>';
		$config['prev_link'] = '&laquo;';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li  class="page-item">';
		$config['next_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-item active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li  class="page-item">';
		$config['num_tag_close'] = '</li>';

		$config['next_link'] = '&raquo;';

		$this->pagination->initialize($config);
		$str = str_replace('<a','<a class="page-link"',$this->pagination->create_links());
		//$str = preg_replace('/\?page=\/+/', '?page=', $str);

		return $str;
	}
}