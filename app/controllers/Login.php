<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

    function index()	{
		// $this->load->view('template/header');
		// $this->load->view('user/index');

		// $this->load->view('template/header');
		$this->load->view('templates/header');
		$this->load->view('index');
	}

	function sign_in() {

		if ( !empty(trim($this->input->post('pseudo'))) AND !empty(trim($this->input->post('mot_de_passe'))) ) {

		 	$pseudo =  trim($this->input->post('pseudo'));	
			$pass   =  sha1(trim($this->input->post('mot_de_passe')));
		    $result =  $this->login->sign_in($pseudo, $pass);
		    if(!$result) {
		    	$_SESSION['flash']['danger'] = 'Soit aucun compte ne correspond ou il n\'est pas encore activé, merci de verifié votre addresse mail pour la confirmation.';
				// $this->load->view('template/header');
				$this->load->view('templates/header');
				$this->load->view('index');			    
			}else {
				foreach ($result as $user) {
			    	if ( !empty($user->pseudo) && $user->mot_de_passe === $pass ) {
			    		$sess_array = array( 
						    'pseudo' => $pseudo,
						    'idmembre' => $user->idmembre,
						    'photo' => $user->photo,
						    'is_logged_in ' => TRUE 
						); 
						$this->session->set_userdata($sess_array);	
						$user = $this->session->userdata();

						redirect('account');
			    	}else if( $user->mot_de_passe != $pass  ) {
			    		$_SESSION['flash']['danger'] = 'Login incorrect ';
						// $this->load->view('template/header');
						$this->load->view('templates/header');
						$this->load->view('index');
			    	}
			    }
			}	 
		} else {
			$_SESSION['flash']['danger'] = '* Remplis les champ svp ';
			// $this->load->view('template/header');
			$this->load->view('templates/header');
			$this->load->view('index');
		}
    }

    function check_if_pseudo_exists($request_pseudo){
    	$pseudo_available = $this->login->check_if_pseudo_exists($request_pseudo);
    	if ($pseudo_available) {
    		return TRUE;
    	}else {
    		return FALSE ;
    	}
    }

    function check_if_email_exists($request_email){
    	$email_available = $this->login->check_if_email_exists($request_email);
    	if ($email_available) {
    		return TRUE;
    	}else {
    		return FALSE ;
    	}    	
    }

    function ckeck_format_nom($nom) {
    	if (!preg_match('/^[a-zA-Z ]+$/', trim($this->input->post('nom')))) {
    		return FALSE ;
    	}else {
    		return TRUE ;
    	}
    }

    function ckeck_format_prenom($prenom) {
    	if (!preg_match('/^[a-zA-Z ]+$/', trim($this->input->post('prenom')))) {
    		return FALSE ;
    	} else {
    		return TRUE ;
    	}
    }

    function ckeck_format_sexe($sexe){
    	if (!preg_match('/^[a-zA-Z]+$/', trim($this->input->post('sexe')))) {
    		return FALSE ;    		
    	} else {
    		return TRUE ;
    	}
    }

    function sexe_valide(){
		if ( (trim($this->input->post('sexe')) === 'Masculin') OR (trim($this->input->post('sexe')) === 'Feminin') ){
				# code...
			return TRUE;
		} else {
			return FALSE ;
		}
    }

    function ckeck_format_pseudo($pseudo){
    	if (!preg_match('/^[a-zA-Z0-9_]+$/', trim($this->input->post('pseudo')))) {
    		return false ;
    	} else {
    		return TRUE ;
    	}
    } 

    function ckeck_format_email($email){
    	if (filter_var(trim($this->input->post('email')), FILTER_VALIDATE_EMAIL) ) {
    		return FALSE ;
    	} else {
    		return TRUE ;
    	}
    }

	public function sign_up() {
		
		$this->form_validation->set_rules('nom', 'nom', 'trim|required|htmlspecialchars|callback_ckeck_format_nom');
		$this->form_validation->set_rules('prenom', 'prenom', 'trim|required|htmlspecialchars|callback_ckeck_format_prenom');
		$this->form_validation->set_rules('sexe', 'sexe', 'trim|required|htmlspecialchars|callback_ckeck_format_sexe|callback_sexe_valide');
		$this->form_validation->set_rules('date_naissance', 'date de naissanse', 'trim|required|htmlspecialchars');
		$this->form_validation->set_rules('pseudo', 'pseudo', 'trim|required|min_length[6]|max_length[12]|htmlspecialchars|callback_check_if_pseudo_exists|callback_ckeck_format_pseudo');
		$this->form_validation->set_rules('mot_de_passe', 'mot de passe', 'trim|required|min_length[8]|htmlspecialchars');
		$this->form_validation->set_rules('mot_de_passe_c', 'Mot de passe de confirmation', 'trim|required|min_length[8]|htmlspecialchars|matches[mot_de_passe]');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|htmlspecialchars|callback_check_if_email_exists');
		// $this->form_validation->set_rules('userfile', 'photo', 'trim|required|valid_email|htmlspecialchars|callback_upload_file');
	
		// if ($this->form_validation->run() === FALSE) {
		// 	$this->load->view('template/header');
		// 	$this->load->view('user/form_register');
		// }else{
			if($this->input->post('save')) {
				if (!empty(trim($this->input->post('nom'))) AND !empty(trim($this->input->post('prenom'))) 
					AND !empty(trim($this->input->post('sexe'))) AND !empty(trim($this->input->post('date_naissance')))
					AND !empty(trim($this->input->post('email'))) AND !empty(trim($this->input->post('pseudo')))
					AND !empty(trim($this->input->post('password'))) AND !empty(trim($this->input->post('password_c')))
					AND !empty(trim($this->input->post('membre'))) AND !empty(trim($this->input->post('reponse')))
					AND !empty(trim($this->input->post('reponse_x'))) AND empty(trim($this->input->post('departement'))) ) {
					# code...
				
					$config['upload_path']          = 'assets/avatar/';
					$config['allowed_types']        = 'gif|jpg|png|jpeg';
					$config['max_size']             = 0;
					// $config['max_width']            = 768;
					// $config['max_height']           = 1024;

					// $this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ( ! $this->upload->do_upload('userfile') )
					{
						$_SESSION['flash']['danger'] = 'l\'images n\'a pas pu etre upload il faut un format : gif | jpg | png | jpeg ' ;
						$error = array('error' => $this->upload->display_errors());
					}
					else
					{
						// $data = array('upload_data' => $this->upload->data());
						$data =  $this->upload->data();					
					}
					if (!empty($data)) {
					    $this->login->sign_up($data);
					}else {
						$this->login->sign_up();
					}

					$user_id = $this->db->insert_id();
					$token 	 = $this->security->get_csrf_hash();
					$email 	 = trim($this->input->post('email')); 

					$url = 'http://localhost/public_html/account/confirmation?id='.$user_id .'&token='.$token; 
					// mail($email, 'Email de confirmation', 'Merci de cliquer pour valide votre compter '.$url);

					// mail($email, 'Email de confirmation', 'Cliquez sur ce lien pour valider votre compte <br /><br /> '.$url);
					// $_SESSION['flash']['success'] = 'Un email de confirmation vous a étè envoyer';
					// header('Location:http://localhost/public_html/login/Sign_in');

					$this->email->from('expertcloudplus@gmail.com', 'Biblioplus');
					$this->email->to($email);
					$this->email->subject('Email de confirmation');
					$this->email->message('Cliquez sur ce lien pour valider votre compte <br /><br />'.$url);
					if ($this->email->send()) {
					  	$_SESSION['flash']['success'] = 'Un email de confirmation vous a étè envoyé';
					}else{
					  	show_error($this->email->print_debugger());
					  	$_SESSION['flash']['success'] = 'Une erreur se produit .. ';	
					}					
					redirect('login/Sign_in');
				} else {
					$_SESSION['flash']['danger'] = '* Remplis tous les champs svp';
					$this->load->view('templates/header');
					$this->load->view('form_register');
				}
			}else{ 
				$this->load->view('templates/header');
				$this->load->view('form_register');
		    }
		// }        
    }
}