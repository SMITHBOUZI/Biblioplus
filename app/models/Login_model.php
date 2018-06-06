<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->database();		
	}

	function sign_in($pseudo, $pass){
		
		$this->db->select('*');
		$this->db->from('membre');
		$this->db->where('pseudo', $pseudo);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		}else{
			return false;
		}
	}

	function check_if_pseudo_exists($pseudo){
		$this->db->WHERE('pseudo', $pseudo);
		$req = $this->db->get('inscription');
		if ($req->num_rows() > 0) {
			return false;
		}else {
			return true;
		}
    }

    function check_if_email_exists($email){
    	$this->db->WHERE('email', $email);
		$req = $this->db->get('inscription');
		if ($req->num_rows() > 0) {
			# code...
			return false;
		}else {
			return true;
		}    	
    }

	function sign_up(){

		$nom = $this->input->post('nom_prenom');
		$sex = $this->input->post('sexe');
		$dat = $this->input->post('date_naissance');
		$pseu = $this->input->post('pseudo');
		$pass = sha1($this->input->post('mot_de_passe'));	
		$ema = $this->input->post('email'); 
		$sta = $this->input->post('mem');
		$desc = $this->input->post('desc');
		
		$co = $this->security->get_csrf_hash();
		$to = $this->input->post('token_confirmed');
		$pho = $this->upload->file_name;

		$data = array(
			'idinscription'		=> '',
			'nom_prenom' 	 	=> $nom,
			'sexe' 			 	=> $sex,
			'date_naissance' 	=> $dat,
			'pseudo'		 	=> $pseu,
			'mot_de_passe' 	 	=> $pass,
			'email'   		 	=> $ema,
			'status'			=> $sta,
			'description'		=> $desc,

			'token_confirmed'	=> $to,
			'confirm_token' 	=> $co,
			'photo'				=> $pho				
		);
		
			
		if ($this->db->insert('inscription', $data)) {
			$user_id = $this->db->insert_id();
			$token 	 = $this->security->get_csrf_hash();

			//send confirmation email
			return $this->send_confirmation_email($ema, $user_id, $token);			
		}
	}

	/**
	 * send_confirmation_email function.
	 * 
	 * @access private
	 * @param string $username
	 * @param string $email
	 * @return bool
	 */
	private function send_confirmation_email($ema, $user_id, $token) {
		
		// load email library and url helper
		$this->load->library('email');
		$this->load->helper('url');
		
		// get the site email address
		$email_address = $this->config->item('site_email');

		// initialize the email configuration
		$this->email->initialize(array(
			'mailtype' => 'html',
			'charset'  => 'utf-8'
		));
		
		// get user registration date
		$registration_date = $this->db->select('token_confirmed')->from('inscription')->where('idinscription', $user_id)->get()->row('token_confirmed');
		
		// prepare the email
		$this->email->from($email_address, $email_address);
		$this->email->to($ema);
		$this->email->subject('Email de confirmation de compte.');
		$message  = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body>';
		// $message .= "Hi " . $pseudo . ",<br><br>";
		// $message .= "Cliquez sur ce lien pour valider votre compte " . base_url() . "<br><br>";
		$message .= "Cliquez sur ce lien: <a href=\"" . base_url() . "account/confirmation/" . $user_id . "/" . $token . "\">pour confirme votre compte.</a>";
		$message .= "</body></html>";
		$this->email->message($message);
		
		// send the email and return status
		// return $this->email->send();		
		$this->email->send();		
	}

	/**
	 * confirm_account function.
	 * 
	 * @access public
	 * @param string $username
	 * @param string $hash
	 * @return bool
	 */
	public function confirm_account($pseudo, $hash) {		
		// find the email for the given user
		$email = $this->db->select('email')
			->from('inscription')
			->where('pseudo', $pseudo)
			->get()
			->row('email');
		
		// find the registration date for the given user
		$registration_date = $this->db->select('token_confirmed')
			->from('inscription')
			->where('pseudo', $pseudo)
			->get()
			->row('token_confirmed');

		// if the user from the url exists
		if ($email && $registration_date) {
			
			if (sha1($email . $registration_date) === $hash) {
				
				// values from the url are good, we can validate the account
				$data = array('token_confirmed' => date('Y-m-j H:i:s'));
				$this->db->where('pseudo', $pseudo);
				return $this->db->update('inscription', $data);				
			}
			return false;			
		}
		return false;		
	}
}