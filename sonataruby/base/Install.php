<?php
namespace Sonata;
defined('BASEPATH') OR exit('No direct script access allowed');
require_once CMS_HMVCPATH."Controller.php";
use Exception;
use stdClass;
use \MX_Controller;

class Install extends MX_Controller{
	function __construct()
	{
		parent::__construct();
		$this->load->helper(['date','cookie','url','form','string','text']);
		$this->load->library(['session','email','user_agent','form_validation']);
		
		define("IS_FRONTEND",true);
		$this->validateInstall();
	}

	private function validateInstall(){
		$database = [];
		
		$file =  APPPATH . "config/database.php";
		require_once $file;
		
		if(isset($db[$active_group]["install"]) && $db[$active_group]["install"]  === TRUE){
			die("CMS Ready install");
		}
		
	}

	public function saveConfig(){
		$file =  APPPATH . "config/database.php";
		$database = array(
			'dsn'	=> '',
			'hostname' => 'localhost',
			'username' => '',
			'password' => '',
			'database' => '',
			'dbdriver' => 'mysqli',
			'dbprefix' => '',
			'pconnect' => FALSE,
			'db_debug' => FALSE,
			'cache_on' => FALSE,
			'cachedir' => '',
			'char_set' => 'utf8',
			'dbcollat' => 'utf8_general_ci',
			'swap_pre' => '',
			'encrypt' => FALSE,
			'compress' => FALSE,
			'stricton' => FALSE,
			'failover' => array(),
			'save_queries' => TRUE
		);

		$database = array_merge($database, ["hostname" => $this->input->post("server"), "username" => $this->input->post("userdb"), "password" => $this->input->post("passdb"), "database" => $this->input->post("database"), "dbdriver" => $this->input->post("driver")]);

		$this->load->helper('file');
		$data = [];
		
		foreach ($database as $key => $value) {
			if(is_array($value)){
				$value = 'array()';
			}else if($value === FALSE){
				$value = 'FALSE';
			}else if($value === TRUE){
				$value = 'TRUE';
			}else{
				$value = '"'.$value.'"';
			}

			$data[] = '"'.$key.'" => '.$value;
		}
		$data[] = '"install" => TRUE';
		

		$write = '<?php'."\n".'defined("BASEPATH") OR exit("No direct script access allowed");'."\n".'
$active_group = "default";'."\n".'
$query_builder = TRUE;'."\n".'
$db["default"] = array('."\n\t".implode($data, ",\n\t")."\n".');';

		if ( ! write_file($file, $write))
		{
		        echo 'Unable to write the file, pls chmod 0777 file '.$file;
		}
		else
		{
		        //echo 'Install ok! <a href="/">Click go home</a>';
		        $this->setUpdatabase();
		        $email = $this->input->post("email");
		        $password = $this->input->post("password");
		        $this->load->model(['account/account_model']);
		        $this->account_model->setAccount($email, $password,1, "enterprise");
		        return true;
		        
		       
		}



		
		
	}

	private function setUpdatabase(){
		$this->load->database();
		
		$this->load->library('migration');
		

        if ( ! $this->migration->current())
        {
        	

            return true;
        } else {
            return false;
        }   
	}
}
