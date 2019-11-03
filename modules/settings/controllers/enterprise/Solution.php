<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use \Sonata\Enterprise;
use \Sonata\Image;
class Solution extends Enterprise {

	public function __construct()
	{
	    parent::__construct();
	     $this->load->helper(['directory','file']);
	    $this->settings_model->setStore($this->store_id);
	}

	public function index(){

	}

	public function builder($channel=""){
		$this->view("solution-builder",["database" => $channel."_options", "mode" => "dataform", "channel" => $channel]);
	}

	public function database($channel=""){
		$database = $channel."_options";
		$fields = [];
		if ($this->db->table_exists($database))
		{
		       $fields = (Array)$this->db->field_data($database);
		}
		if($this->isPost()){
			$this->load->dbforge();
			if ($this->db->table_exists($database))
			{
				$fileData = $this->input->post("name");
				$fileType = $this->input->post("type");
				$fileLength = $this->input->post("length");
				$fileArv = [];
				foreach ($fileData as $key => $value) {
					$name = str_replace([' ','-'],'',strtolower($value));
					if (!$this->db->field_exists($name, $database)){
						
						$fileArv[$name] = [
							"type" => $fileType[$key],
							"constraint" => $fileLength[$key],
							"default" => ""
						];
					}
					$this->dbforge->add_column($database, $fileArv);
				}
			}else{
				

				$fields = array(
                        'p_id' => array(
                                                 'type' => 'BIGINT',
                                                 'constraint' => 20,
                                                 'unsigned' => TRUE,
                                                 'auto_increment' => TRUE
                                          ),
                        'post_id' => array(
                                                 'type' => 'BIGINT',
                                                 'constraint' => 20,
                                          ),
                        
                );

				$this->dbforge->add_field($fields);

				$this->dbforge->add_key('p_id', TRUE);
				// gives PRIMARY KEY (blog_id)

				$this->dbforge->add_key('post_id');
				// gives KEY (blog_title)

				$this->dbforge->create_table($database,TRUE);

			}
		}
		$this->view("solution-builder",["database" => $database,"fields" => $fields, "mode" => "dataform", "channel" => $channel]);
	}

	public function layout($channel="", $layout=""){


		$module_path = array_keys(CMS_MODULESPATH)[0];
		if($layout == "list") $layout = "posts-list";
		if($layout == "detail") $layout = "post";

		$file = CMS_THEMEPATH . TEMPLATE_ACTIVE . "/channel/{$channel}/{$layout}.php";

		if($this->isPost()){
			if(!is_dir(CMS_THEMEPATH . TEMPLATE_ACTIVE . "/channel/{$channel}")){
				mkdir(CMS_THEMEPATH . TEMPLATE_ACTIVE . "/channel/{$channel}",0777, true);
			}
			$data = $this->input->post("content");
			
			write_file($file, $data);
			$this->go("settings/enterprise/solution/layout/{$channel}/{$layout}");

		}

		if(!file_exists($file)){
			$file = $module_path. "posts/views/{$layout}.php";
		}
		
		$code = "";


		if(file_exists($file)){
			$code = file_get_contents($file);
		}
		$this->view("solution-builder",["database" => $channel."_options", "mode" => "code","channel" => $channel, "code" => $code]);
	}
}