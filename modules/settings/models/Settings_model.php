<?php
use \Sonata\Model;

class Settings_model extends Model{
	private $table = "settings";
	public function save($arv=[]){
		foreach ($arv as $key => $value) {
			
			$data = $this->db->get_where($this->table,["config_name" => $key, "store" => $this->store_id])->row();
			
			$value = is_array($value) ? json_encode($value) : $value;

			if($data){
				$this->db->update($this->table,["config_value" => $value],["config_id" => $data->config_id]);
			}else{
				$this->db->insert($this->table,["config_name" => $key,"config_value" => $value, "language" => $this->config->item("language"), "store" => $this->store_id]);
			}
		}

		$this->putDataCache();
	}


	public function getData($language=false, $autoload=false){
		$language = (!$language ? $this->config->item("language") : $language);
		
		$this->db->where("language", $language);
		
		if($this->store_id) $this->db->where("store", $this->store_id);
		if($autoload){
			
			$this->db->where("autoload", $autoload);
		}
		$data = $this->db->get($this->table)->result();
		$arv = new stdClass;
		foreach ($data as $key => $value) {
			$arv->{$value->config_name} = $value->config_value;
		}

		return $arv;
	}

	public function putDataCache(){
		$this->load->helper('file');
		$getData = $this->getData();
		$data = json_encode($getData);
		write_file(CONFIG_LOCAL . strtolower(DOMAIN).".json",$data);


		/*
		Update Store Condig
		*/
		$dataStore = $this->db->get("stores")->result();
		$arv = [];
		foreach ($dataStore as $key => $value) {
			if($value->is_root == 1){
				$arv["root_domain"] = ["domain" => $value->store_domain, "store_id" => $value->store_id];
			}else{
				$arv["allow_domain"][$value->store_domain] = $value->store_id;
			}
		}
		$data = json_encode($arv);
		write_file(CONFIG_LOCAL . "mainconfig.json",$data);

	}



	public function reports(){

		$clientIP = $this->input->server("HTTP_CF_CONNECTING_IP") ? $this->input->server("HTTP_CF_CONNECTING_IP") : $this->input->server("HTTP_X_FORWARDED_FOR");

		if(!$this->session->has_userdata("connectlocal")){
			$data = [
				"ip" => $clientIP,
				"browser" => $this->agent->browser(),
				"platform" => $this->agent->platform(),
				"hash" => sha1($this->agent->platform() . $clientIP),
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
			$check = $this->db->get_where("reports_robots", ["bot_name" => $this->agent->robot(),"store" => DOMAIN, "language" => config_item("language")])->row();
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
				
				$getlocation = @json_decode(@file_get_contents("http://www.geoplugin.net/json.gp?ip=".$clientIP));
				$city = (@$getlocation->geoplugin_city ? $getlocation->geoplugin_city : "N/A");
				$region = (@$getlocation->geoplugin_regionName ? $getlocation->geoplugin_regionName : "N/A");
				$country = (@$getlocation->geoplugin_countryName ? $getlocation->geoplugin_countryName : "N/A");
				$continent = (@$getlocation->geoplugin_continentName ? $getlocation->geoplugin_continentName : "N/A");
				$this->db->insert("reports_views",["view_url" => current_url(),"view_update" => getDateSQL(), "view_created" => getDateSQL(), "view_count" => 1, "hash_connect" => $data["hash"], "view_hash" => $hashview, "is_bot" => $this->agent->is_robot(), "platform" => $this->agent->platform(), "browser" => $this->agent->browser(), "is_mobile" => $this->agent->is_mobile(), "form_ip" => $clientIP, "store" => DOMAIN, "language" => config_item("language"), "city" => $city, "region" => $region, "country" => $country, "continent" => $continent, "open_form_url" => $this->validate_form_url()]);
			}
			$this->session->set_userdata('addhistory', $hashview);
		}
	}


	public function validate_form_url(){
		$arv = ["fbclid" => "Facebook"];
		$get = $this->input->get();
		if(isset($get["fbclid"])){
			return $arv["fbclid"];
		}
		return 'N/A';
	}
}