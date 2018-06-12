<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	var $data = array();

	function __construct(){
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('account_model');
	}
 
	public function index() {
		if ($this->session->get_userdata('logged_in')) {
			$session_data 	 = $this->session->userdata('logged_in');
			$data['id']		 = $session_data['id'];
			$data['pseudo']	 = $session_data['pseudo'];
			$data['photo'] 	 = $session_data['photo'];

			$this->load->view('templates/header', $data);
			$this->load->view('index');
		}else{
			redirect('user_connect', 'refresh');
		}
	}

	function search_bar(){
		$search = $this->input->post('search_bar');
		$fetch = $this->account->search_bar($search);
		if ($fetch) {
			foreach ($fetch as $key) {
				$data = array(
					'pseudo'			=> $key->pseudo,
					'email'				=> $key->email,
					'sexe'				=> $key->sexe,
					'date_naissance'	=> $key->date_naissance,
					'status'			=> $key->status,
					'photo'				=> $key->photo,
					'nom_prenom'		=> $key->nom_prenom
				);
			}
			$this->load->view('templates/header');
			$this->load->view('search', $data);
		}
	}

	public function logout() {
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		   		
		header('Location:index');
	}

    function confirmation(){
		$user_id = $this->uri->segment(3);
		$token = $this->uri->segment(4);

		// load form helper 
		$this->load->helper('form');
		
		$result  = $this->account_model->confirmation($user_id, $token);
		if ($result) {
			foreach ($result as $user) {
				if ($user && $user->confirm_token === $token) {
					$_SESSION['flash']['info'] = 'Votre compté a étè confirmé avec succés' ;
					$this->load->view('templates/header');
					$this->load->view('sign_in');
				}
				else{
					$this->load->view('templates/header');
					$_SESSION['flash']['danger'] = 'Ce token n\'est plus valide' ;
					$this->load->view('sign_in');
				}				
			}			
		} else {
			$this->load->view('templates/header');
			$_SESSION['flash']['danger'] = 'Ce token n\'est plus valide' ;
		    $this->load->view('sign_in');
		}
    }

    function pass_fotgot() {
    	$this->load->helper('form');

    	if (!empty(trim($this->input->post('email')))) {

			$email = trim($this->input->post('email'));
			$reset_token = $this->security->get_csrf_hash();
			 
			$req = $this->account_model->password_fotgot($reset_token, $email); 
			 
			if ($req) {				
				$_SESSION['flash']['success'] = 'Un mail de réinitialisation vous a été envoyé ';		
		
				$this->load->view('templates/header');
				$this->load->view('mail_recup');

			} else{
				$_SESSION['flash']['danger'] = 'Aucun compter ne correspond a cet email ';
				// $this->Exceptions->show_error();
				$this->load->view('templates/header');
				$this->load->view('mail_recup');
			}
		} else {
			$this->load->view('templates/header');
			$this->load->view('mail_recup');
		}
    }

    function password_reset(){
    	$this->load->helper('form');
    	$this->load->library('form_validation');

		$reset_token = $this->uri->segment(3);
        
		$result  = $this->account_model->password_reset($reset_token);
		if ($result) {
			foreach ($result as $user) {
				if ($user && $user->reset_token == $reset_token) {
					$this->load->view('templates/header');
					$this->load->view('pass_reset');
				} else{
					$this->load->view('templates/header');
					$_SESSION['flash']['danger'] = 'Ce token n\'est plus valide ' ;
					$this->load->view('pass_reset');
				}				
			} 		
		} else {
			$this->load->view('templates/header');
			$_SESSION['flash']['danger'] = 'Ce token n\'est plus valide ' ;
			$this->load->view('sign_in');
		}
    }

    function update_pass(){
    	$this->load->helper('form');
    	$this->load->library('form_validation');
    	$this->form_validation->set_rules('mot_de_passe', 'nouveau mot de passe', 'trim|required|min_length[8]|htmlspecialchars');
		$this->form_validation->set_rules('mot_de_passe_c', 'mot de passe de confirmation', 'trim|required|min_length[8]|htmlspecialchars|matches[mot_de_passe]');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header');
			$this->load->view('pass_reset');
		}else {
			$mot_de_passe = sha1($this->input->post('mot_de_passe'));
			$query = $this->account_model->update_pass($mot_de_passe);
			if ($query) {
				$_SESSION['flash']['success'] = 'Votre mot de passe a été modifier avec succés ';
				$this->load->view('templates/header');
				$this->load->view('sign_in');
			}else {
				$_SESSION['flash']['danger'] = 'Une erreur ce produit lors de la mise a jour de votre mot de passe ';
				$this->load->view('templates/header');
				$this->load->view('mail_recup');
			}			
		}
    }
}