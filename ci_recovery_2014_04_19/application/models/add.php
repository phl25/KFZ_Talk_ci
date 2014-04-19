<?php

class Add extends CI_Model {
	
	function addPerson(){
		
		$newPerson = array(
			'vorname' => $this->input->post('vname'),
			'nachname' => $this->input->post('nname')
		);
		
		$insert = $this->db->insert('TN', $newPerson);
		return $insert;
		
	}
	
	
	
}



?>
