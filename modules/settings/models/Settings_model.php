<?php
use \Sonata\Model;

class Settings_model extends Model{
	private $table = "settings";
	public function save($arv=[]){
		foreach ($arv as $key => $value) {
			$data = $this->db->get_where($this->table,["config_name" => $key])->row();
			
			$value = is_array($value) ? json_encode($value) : $value;

			if($data){
				$this->db->update($this->table,["config_value" => $value],["config_id" => $data->config_id]);
			}else{
				$this->db->insert($this->table,["config_name" => $key,"config_value" => $value, "language" => $this->config->item("language"), "store" => DOMAIN]);
			}
		}

		$this->putDataCache();
	}


	public function getData($language=false){
		$language = (!$language ? $this->config->item("language") : $language);
		$store = DOMAIN;
		$this->db->where("language", $language);
		$this->db->where("store", $store);
		$data = $this->db->get($this->table)->result();
		$arv = new stdClass;
		foreach ($data as $key => $value) {
			$arv->{$value->config_name} = $value->config_value;
		}
		return $arv;
	}

	public function putDataCache(){
		$this->load->helper('file');
		$data = json_encode($this->getData());
		write_file(CONFIG_LOCAL . strtolower(DOMAIN).".json",$data);
	}
}