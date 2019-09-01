<?php
namespace Sonata;
defined('BASEPATH') OR exit('No direct script access allowed');

use Exception;
use stdClass;
use \CI_Model;
class Model extends CI_Model{
	public $limit=20;
	public $total = 0;
	public $store_id =0;
	public $field_excel = [];

	function __construct($a=0)
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
	public function setStore($id){
		$this->store_id = $id;
		
	}


	public function setExcel($arv=[]){
		$this->field_excel = $arv;
	}


	public function importExcel($arv=[], $table=""){

	}


	public function exportExcel($arv=[], $table=""){

	}

	public function example($number=1, $table=""){
		if(!$table) return false;
		
		for ($i=0; $i < $number; $i++) { 
			$arv = [];
			foreach ($this->field_excel as $key => $value) {
				if($value != "id"){
					$arv[$key] = $this->makeSampleData($value);
				}
			}
			$this->db->insert($table, $arv);
		}
		
		
		
	}

	private function makeSampleData($key){
		$faker = \Faker\Factory::create('vi_VN');
		switch ($key) {
			case 'name':
				return $faker->name;
			break;
			case 'content':
				return ucfirst($faker->text('2000'));
			break;
			case 'description':
				return ucfirst($faker->text('200'));
			break;
			case 'image':
				return $faker->imageUrl(640, 320);
			break;
			case 'datetime':
				return $faker->dateTime(time())->format('Y-m-d h:i:s');
			break;
			case 'athour_id':
				return is_login();
			break;
			case 'title':
				return ucfirst($faker->text('100'));
			break;
			case 'title_url':
				return url_title(convert_accented_characters($faker->text('100')),"-",true);
			break;
			case 'tags':
				return implode(explode(' ', $faker->text('100')), ", ");
			break;
			default:
				return $key;
			break;
		}
	}

}