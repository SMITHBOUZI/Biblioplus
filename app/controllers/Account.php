<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

	var $data = array();

	function __construct(){
		parent::__construct();
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
	}

    function sign_out() {
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
		   		
		header('Location:index');
    }

    function confirmation(){
    	$user_id = $_GET['id'];
		$token	 = $_GET['token'];
		$result  = $this->account->confirmation($user_id, $token);
		if ($result) {
			foreach ($result as $user) {
				if ($user && $user->confirm_token === $token) {
					$_SESSION['flash']['info'] = 'Votre compté a étè confirmé avec succés' ;
					$this->load->view('templates/header');
					$this->load->view('index');
				}
				else{
					$this->load->view('templates/header');
					$_SESSION['flash']['danger'] = 'Ce token n\'est plus valide' ;
					$this->load->view('index');
				}				
			}			
		} else {
			$this->load->view('templates/header');
			$_SESSION['flash']['danger'] = 'Ce token n\'est plus valide' ;
		    $this->load->view('index');
		}
    }

    function pass_fotgot() {

    	if (!empty(trim($this->input->post('email')))) {	

			$email = trim($this->input->post('email'));
			$reset_token = $this->security->get_csrf_hash();
			 
			$req = $this->account->password_fotgot($email, $reset_token); 
			 
			if ($req) {
				$reset_token = $this->security->get_csrf_hash();
				// https://expertcloudplus.000webhostapp.com/
				$url = "http://localhost/gitbiblioplus/public_html/account/password_reset?token=".$reset_token;
				 
				// mail($email, 'Email de confirmation', 'Cliquez sur ce lien pour valider votre compte.:  '.$url); 
				// $_SESSION['flash']['success'] = 'Un mail de réinitialisation vous a étè envoyer ';
				// header('Location:https://expertcloudplus.000webhostapp.com/login/Sign_in');

				$this->email->from('expertcloudplus@gmail.com', 'Biblioplus');
				$this->email->to($email);
				$this->email->subject('Email de réinitialisation de mot de passe');
				$this->email->message('Cliquez sur ce lien pour valider votre compte.: '.$url);
				if ($this->email->send()) {
					$this->load->view('templates/header');
					$_SESSION['flash']['success'] = 'Un mail de réinitialisation vous a étè envoyer ';
					$this->load->view('index');
				}else{
					show_error($this->email->print_debugger());
					$_SESSION['flash']['danger'] = 'Une erreur se produit .. ';	
				}
			} else{
				$_SESSION['flash']['danger'] = 'Aucun compter ne correspond a cet email ';
				$this->load->view('templates/header');
				$this->load->view('mail_recup');
			}
		} else {			
			$this->load->view('templates/header');
			$this->load->view('mail_recup');
		}
    }

    function password_reset(){
		$reset_token	 = $_GET['token'];
        
		$result  = $this->account->password_reset($reset_token);
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
			$this->load->view('index');
		}
    }

    function update_pass(){
    	$this->form_validation->set_rules('mot_de_passe', 'mot de passe', 'trim|required|min_length[8]|htmlspecialchars');
		$this->form_validation->set_rules('mot_de_passe_c', 'mot de passe de confirmation', 'trim|required|min_length[8]|htmlspecialchars|matches[mot_de_passe]');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('templates/header');
			$this->load->view('pass_reset');
		}else {
			$mot_de_passe = sha1($this->input->post('mot_de_passe'));
			$query = $this->account->update_pass($mot_de_passe);
			if ($query) {
				$_SESSION['flash']['success'] = 'Votre mot de passe a étè modifier avec succés ';
				$this->load->view('templates/header');
				$this->load->view('index');
			}else {
				$_SESSION['flash']['danger'] = 'Une erreur ce produit lors de la mise a jour de votre mot de passe ';
				$this->load->view('templates/header');
				$this->load->view('index');
			}			
		}
    }

    public function form_uploaded_doc() {
		$this->form_validation->set_rules('titre', 'titre', 'trim|required|htmlspecialchars');
		$this->form_validation->set_rules('categorie', 'categorie', 'trim|required|htmlspecialchars');
		$this->form_validation->set_rules('pages', 'pages', 'trim|required|htmlspecialchars');
		// $this->form_validation->set_rules('userfile', 'photo', 'trim|required|htmlspecialchars');
		$this->form_validation->set_rules('isbn', 'isbn', 'trim|required|htmlspecialchars');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('template/header');
			$this->load->view('user/form_uploaded_doc');
		}else{
			if($this->input->post('save')) {
				$config['upload_path']          = 'assets/livres/';
				$config['allowed_types']        = 'doc|pdf|docx';
				$config['max_size']             = 0;

				$this->upload->initialize($config);
				
				if ( ! $this->upload->do_upload('userfile') ) {
					$_SESSION['flash']['warning'] = 'Ce format n\'est pas prisse en charger ' ;
					$_SESSION['flash']['info'] = 'Essayer avec un format doc | pdf ' ;
					$error = array('error' => $this->upload->display_errors());
					$this->load->view('template/header');
					$this->load->view('user/form_uploaded_doc');					
				} else {
					$data =  $this->upload->data();			
				} if (!empty($data)) {
				    $this->account->form_uploaded_doc($data);
				    $_SESSION['flash']['success'] = 'Vous venez d\'ajouter un livre felicitation ' ;
				    $this->load->view('template/header');
					$this->load->view('user/form_uploaded_doc');
				}
			}
		}		     
    }

    function profil(){

    	$query = $this->session->get_userdata('logged_in');
    	$idmembre = $query['idmembre'];
    	
    	$sql = $this->account->fetch($idmembre);
    	if ($sql) {
    		foreach ($sql as $rows) {
	    		$data = array(
	    			'idmembre'  => $rows->idmembre,
	    			'photo'		=> $rows->photo,
	    			'pseudo'    => $rows->pseudo,
	    			'email'		=> $rows->email
	    		);
		    	$this->load->view('template/header');
				$this->load->view('user/profile', $data);
    		}
    	} else {
    		echo "Donner non touver!! ";
    	}
    }

    function update_profil(){
    	$query = $this->session->get_userdata('logged_in');
    	$idmembre = $query['idmembre'];
    	
    	$sql = $this->account->fetch($idmembre);
    	if ($sql) {
    		foreach ($sql as $rows) {
	    		$data = array(
	    			'idmembre'  => $rows->idmembre,
	    			'photo'		=> $rows->photo,
	    			'pseudo'    => $rows->pseudo,
	    			'email'		=> $rows->email
	    		);
		    	$this->load->view('template/header');
				$this->load->view('user/update_profil', $data);
    		}
    	}
    }

    function profil_up(){
		if ($this->input->post('update')) {
			if ( !empty($this->input->post('pseudo')) AND !empty($this->input->post('email')) ) {
				$query = $this->session->get_userdata('logged_in');
		    	$idmembre = $query['idmembre'];
		    	$sql = $this->account->fetch($idmembre);
		    	
				$pseudo = trim($this->input->post('pseudo'));
				$email  = trim($this->input->post('email'));
				$req = $this->account->profil_up($pseudo, $email);

				foreach ($sql as $rows) {
			    		$data = array(
			    			'idmembre'  => $rows->idmembre,
			    			'photo'		=> $rows->photo,
			    			'pseudo'    => $rows->pseudo,
			    			'email'		=> $rows->email
			    		);
				    	$this->load->view('template/header');
						$this->load->view('user/profile', $data);
		    		}
			} else {
				$_SESSION['flash']['danger'] = 'Ces champs ne doit pas etre vide ' ;
				$query = $this->session->get_userdata('logged_in');
		    	$idmembre = $query['idmembre'];
		    	
		    	$sql = $this->account->fetch($idmembre);
		    	if ($sql) {
		    		foreach ($sql as $rows) {
			    		$data = array(
			    			'idmembre'  => $rows->idmembre,
			    			'photo'		=> $rows->photo,
			    			'pseudo'    => $rows->pseudo,
			    			'email'		=> $rows->email
			    		);
				    	$this->load->view('template/header');
						$this->load->view('user/update_profil', $data);
		    		}
		    	}
			}
		} else {
			// echo "Lal";
		}
    }    
}