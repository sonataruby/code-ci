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



	public function reports(){
		if(!$this->session->has_userdata("connectlocal")){
			$data = [
				"ip" => $this->input->ip_address(),
				"browser" => $this->agent->browser(),
				"platform" => $this->agent->platform(),
				"hash" => sha1($this->agent->platform() . $this->input->ip_address()),
				"isBot" => $this->agent->robot(),
				"mobile" => $this->agent->mobile(),
			];
			$this->session->set_userdata('connectlocal', $data);
		}
		$data = $this->session->userdata('connectlocal');
		$check = $this->db->get_where("reports", ["hash" => $data["hash"]])->num_rows();

		if($check == 0){
			$this->db->insert("reports",["hash" => $data["hash"], "store" => DOMAIN, "language" => config_item("language")]);
		}

		if($this->agent->is_robot()){
			$check = $this->db->get_where("reports_robots", ["bot_name" => $this->agent->robot()])->row();
			if(!isset($check->bot_id)){
				$this->db->insert("reports_robots",["bot_name" => $this->agent->robot(), "store" => DOMAIN, "language" => config_item("language"), "firstconnect" => getDateSQL()]);
			}else{
				$this->db->update("reports_robots",["reconnect" => getDateSQL(), "count_connect" => ($check->count_connect + 1)],["bot_id" => $check->bot_id]);
			}
		}


		/*
		Add Session history url
		*/
		$hashview = sha1(current_url());
		if(!$this->session->has_userdata("addhistory") || $this->session->userdata('addhistory') != $hashview){
			
			$arv = @array_splice(array_unique($this->session->userdata('history')), 0, 5);
			$arv = @array_merge([$hashview => current_url()], ($arv ? $arv : []));
			$this->session->set_userdata('history', $arv);
			
			$check = $this->db->get_where("reports_views", ["view_hash" => $hashview, "hash_connect" => $data["hash"]])->row();

			if(isset($check->view_id)){
				$this->db->update("reports_views",["view_update" => getDateSQL(), "view_count" => ($check->view_count + 1)],["view_id" => $check->view_id]);
			}else{
				$this->db->insert("reports_views",["view_url" => current_url(),"view_update" => getDateSQL(), "view_created" => getDateSQL(), "view_count" => 1, "hash_connect" => $data["hash"], "view_hash" => $hashview, "is_bot" => $this->agent->is_robot(), "platform" => $this->agent->platform(), "browser" => $this->agent->browser(), "is_mobile" => $this->agent->is_mobile(), "form_ip" => $this->input->ip_address(), "store" => DOMAIN, "language" => config_item("language")]);
			}
			$this->session->set_userdata('addhistory', $hashview);
		}
	}
}