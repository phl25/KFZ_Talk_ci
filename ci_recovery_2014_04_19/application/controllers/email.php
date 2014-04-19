<?php
	
/*
* SENDS EMAIL WITH GMAIL
*
*/

Class Email extends CI_Controller {
	
	function index() {
		
		$this->load->view('newsletter');
		
	}
	
	function send()
	{
		$this->load->library('form_validation');
		
		//field name, error message, validation rules
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|valid_email');
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('newsletter');
		}		
		else {
			$name = $this->input->post('name');
			$email = $this->input->post('email');
			
			$this->load->library('email');
		
			$this->email->set_newline("\r\n");
		
			$this->email->from('philipp.epstein@gmail.com', 'Phil');
			$this->email->to($email);
			$this->email->subject('Test Newsletter Sign UP Confirmation');
			$this->email->message('Hallo'.$name.'Danke, dass sie sich für den Newsletter angemeldet haben.');
		
			$path = $this->config->item('server_root');
			$file = $path . '/ci/attachments/information.txt';

			$this->email->attach($file);
		
		
			if($this->email->send()){
				echo 'Sie haben sich erfolgreich für den Newsletter angemeldet!';
			}
			else {
				show_error($this->email->print_debugger()); 
			} 
		}
		
		
		
	}
	
} 