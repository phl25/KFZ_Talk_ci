<?php

class Pkfz extends CI_Controller {
	
	function index() 
	{
		$is_logged_in = $this->session->userdata('is_logged_in');
		
		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			$data['main_content'] = 'pstart';
			$this->load->view('includes/template', $data); 		
		} else {
			
			redirect('pkfz_site/members_area');
			
		}
		
	}
	
	function signup()
	{	
		$data['main_content'] = 'preg';
		$this->load->view('includes/template', $data);
	}
	
	function validate_active(){
		
		$this->load->model('pkfzmodel');
		
		if($this->pkfzmodel->validate_active()){
			
			$this->validate();
			
		} else{
			
			$data['main_content'] = 'pnot_active';
			$this->load->view('includes/template', $data);
			
		}
		
		
	}
	
	function validate()
	{
		$this->load->model('pkfzmodel');
		
		if($this->pkfzmodel->validate())
		{
			//Wenn die eingegebenen Daten richtig waren, wird eine session angelegt.
			
			$data = array(
				'kenn' => $this->input->post('kenn'),
				'is_logged_in' => true
			);
			
			$this->session->set_userdata($data);
			
			redirect('pkfz_site/members_area');
			
		} else {

			$data['main_content'] = 'pwrong_login';
			$this->load->view('includes/template', $data);

		}
		
	}
	
	function restricted()
	{
		
		$data['main_content'] = 'prestricted';
		$this->load->view('includes/template', $data);
		
	}
	
	function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}
	
	function addMember()
	{
	/*
	hier kommt man drauf, sobald man im psignup view auf registrieren gedrückt hat.
	Es wird überprüft, ob alles richtig eingegeben wurde. Das heißt ob ein Kennzeichen eingegeben wurde und ob die 	Passwörter übereinstimmen.
	das model wird geladen, die Daten die man eingegeben hat werden in die Datenbank geschrieben und 
	man wird auf den loginscreen weitergeleitet. 
	*/
	$this->load->library('form_validation');

	$this->form_validation->set_rules('kenn1', 'Kennzeichen1', 'required');
	$this->form_validation->set_rules('kenn2', 'Kennzeichen2', 'required');
	$this->form_validation->set_rules('kenn3', 'Kennzeichen3', 'required');
	
	$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[hp_user.email]');
	$this->form_validation->set_rules('pass', 'Passwort', 'required');
	$this->form_validation->set_rules('pass2', 'Passwort wiederholen', 'required|matches[pass]');
	$this->form_validation->set_rules('license', 'callback_license_check');	
	
	if($this->form_validation->run() == FALSE)
	{
			$data['main_content'] = 'preg';
			$this->load->view('includes/template', $data);
	
	} else{
			
	
	$activation_code = $this->generateRandomString();
	
	$this->load->model('pkfzmodel');
	$query = $this->pkfzmodel->createMember($activation_code);
	
	
	
	$link = base_url().'index.php/pkfz/registration_confirmation/'.$activation_code;
	
	$this->email->from('info@kfz.de', 'KFZ Talk');
	$this->email->to($this->input->post('email'));
	$this->email->subject('Email Adresse aktivieren');
	$this->email->message('Bitte auf den'.anchor($link, 'Link').'klicken um Ihre Emailadresse zu bestätigen');	
	
	echo('Bitte auf den'.anchor($link, 'Link').'klicken um Ihre Emailadresse zu bestätigen');
	
	//$this->email->send();

}	
}
function registration_confirmation()
{

	$registration_code = $this->uri->segment(3);	
	
	if(empty($registration_code)){
		
		$data['main_content'] = 'preg';
		$this->load->view('includes/template', $data);
		
	}else{
	
	
	$this->load->model('pkfzmodel');
	$success = $this->pkfzmodel->confirm_registration($registration_code);
	
	if($success)
		{
			$data['main_content'] = 'preg_success';
			$this->load->view('includes/template', $data);
		} else
		{
			$data['main_content'] = 'preg';
			$this->load->view('includes/template', $data);		
		}
	
	}
	}
	
	
	
	
	function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
	
	
	
	
}




?>