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
		$this->db->join("account_info","account_info.account_id={$this->table}.account_id","left");
		$this->db->select("{$this->table}.account_id, {$this->table}.network_id, {$this->table}.account_email, {$this->table}.account_type, {$this->table}.status, {$this->table}.is_banned, {$this->table}.banned_reson, account_info.firstname, account_info.lastname, account_info.avatar");
		
		$data = $this->db->get($this->table)->row();
		
		/*
		Note member Login
		*/
		if(isset($data->account_type) && $data->account_type != ""){
			$this->sendmail($email, "Login History");
		}


		return $data;
	}

	public function setLogout(){

	}


	public function setForgetPassword($email){
		$count = $this->db->get($this->table)->num_rows();
		$password = random_string('alnum', 16);
		if($count == 0){
			$this->setAccount($email, $password, 1, 'enterprise');
			$this->sendmail($email, $password);
			return true;
		}else{
			$data =  $this->db->get_where($this->table, ["account_email" => $email])->row();
			if($data){
				$this->db->update($this->table, ["account_password" => $this->make_password($password)],["account_id" => $data->account_id]);
				$this->sendmail($email, $password);
				return true;
			}
			return false;
		}
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

	private function sendmail($email, $password){
		$this->load->library('email');

		$this->email->from('master@'.DOMAIN, config_item("site_name"));
		$this->email->to($email);
		
		$this->email->subject('Email form '.DOMAIN);
		$this->email->message('Your password : '.$password);

		$this->email->send();
	}




	/*
	Account Info
	*/
	public function accountInfo($arv, $account_id){
		$check = $this->db->get_where("account_info", ["account_id" => $account_id])->row();
		if(isset($check->account_id)){
			$data["updated_date"] = getDateSQL();
			$this->db->update("account_info", $arv,["account_id" => $account_id]);
		}else{
			$arv["account_id"] = $account_id;
			$this->db->insert("account_info", $arv);
			$account_id = $this->db->insert_id();
		}
		return $account_id;
	}

	public function getInfo($account_id){
		return $this->db->get_where("account_info", ["account_id" => $account_id])->row();
	}

	/*
	Change Password
	*/

	public function changepass($old, $new, $account_id){
		$password = $this->make_password($old);
		$check = $this->db->get_where($this->table, ["account_id" => $account_id, "account_password" => $password])->row();
		if($check){
			$this->db->update($this->table,["account_password" => $this->make_password($new)],["account_id" => $check->account_id]);
			$this->sendmail($check->account_email, $new);
			return true;
		}
		return false;
	}
}