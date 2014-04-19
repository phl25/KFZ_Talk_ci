<?php

class Anmeldung extends CI_Controller {
	
	function index() {
		$this->load->view('eingabemaske');	
	}
	
	function create() {
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('vname', 'Vorname', 'required');
		$this->form_validation->set_rules('nname', 'Nachname', 'required');
		
		if($this->form_validation->run() == FALSE) {
			$this->load->view('eingabemaske');
		} else {
			
		$this->load->model('add');	
		$this->add->addPerson();
		$this->load->view('erfolg_anlegen');

			
		}
		
		
		
		
		
	}
	
}





?>