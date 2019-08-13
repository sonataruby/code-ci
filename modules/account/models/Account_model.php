<?php
use \Sonata\Model;

class Account_model extends Model{
	private $table = "account";
	public function setAccount($email, $password, $status=0, $type=""){
		$email = $this->make_email($email);
		$password = $this->make_password($password);
		$check = $this->validate($email);
		$status = (!$status ? config_item("member_default_status") : $status);
		$id = 0;
		if(intval($check) == 0){
			$this->db->insert($this->table, ["account_email" => $email, "account_password" => $password,"account_type" => $type, "status" => $status, "created_date" => getDateSQL()]);
			$id = $this->db->insert_id();
		}
		return $id;
	}


	public function setLogin($email, $password){
		$check = $this->make_email($email);
		$password = $this->make_password($password);
		$this->db->limit(1);
		$this->db->where("account_email", $email);
		$this->db->where("account_password", $password);
		$this->db->where("status",1);
		$this->db->select("account_id, network_id, account_email, account_type, status, is_banned, banned_reson");
		
		$data = $this->db->get($this->table)->row();
		return $data;
	}

	public function setLogout(){

	}
	
	private function validate($email){
		return $this->db->get_where($this->table, ["account_email" => $email])->num_rows();
	}


	private function make_password($password){
		$search = [];
		$password = str_replace($search, '', $password);
		$password = trim(strtolower($password));

		return sha1($password);
	}

	private function make_email($email){
		$email = trim(strtolower($email));
		return $email;
	}
}