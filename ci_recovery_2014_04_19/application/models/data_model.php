<?php
	
class Data_model extends CI_model {
	
	function getAll() {
		$q = $this->db->query("SELECT * FROM test");
		
		if($q->num_rows() > 0 ) {
			
			foreach($q->result() as $row) {
				
				$data[] = $row;
				
			}
			return $data;
			
		}
		
	}
	
	
}