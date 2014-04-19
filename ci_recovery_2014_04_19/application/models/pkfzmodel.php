<?php

class Pkfzmodel extends CI_Model{
	
	function createMember($activation_code)
	{
		$kenn1 = $this->input->post('kenn1');
		$kenn2 = $this->input->post('kenn2');
		$kenn3 = $this->input->post('kenn3');
		
		$license = $kenn1 . $kenn2 . $kenn3;
		
		$new_member = array(
		'license' 			=> $license,
		'passphrase' 		=> md5($this->input->post('pass')),
		'kenn1'				=> $kenn1,
		'kenn2'				=> $kenn2,
		'kenn3'				=> $kenn3,
		'email'				=> $this->input->post('email'),
		'activation_code'	=> $activation_code,
		);
		
		$insert = $this->db->insert('hp_user', $new_member);
		return $insert;
		
	}
	
	function validate()
	{
		$this->db->where('license', $this->input->post('kenn'));
		$this->db->where('passphrase', md5($this->input->post('pass')));
		
		$query = $this->db->get('hp_user');
		
		if($query->num_rows() == 1)
		{
			
			return true;
		}
		
		
	}
	
	function validate_active()
	{
		$this->db->where('license', $this->input->post('kenn'));
		$this->db->where('activated', 1);
		
		$query = $this->db->get('hp_user');
		
		if($query->num_rows() == 1)
		{
			return true;
		}
		
		
		
	}
	
	function confirm_registration($registration_code)
	{
		
		$query_str = "SELECT id FROM hp_user WHERE activation_code = ?";
	
		$result = $this->db->query($query_str, $registration_code);
	
		if($result->num_rows() == 1)
		{
			$query_str = "UPDATE hp_user SET activated = 1 WHERE activation_code = ?";
			$this->db->query($query_str, $registration_code);
			
			return true;
		} else {
			
			return false;
		}
	
			
	
	
	
	
}
}


?>