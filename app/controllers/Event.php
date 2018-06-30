<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

	function __construct() {
	  parent::__construct();
	  $this->load->library(array('session'));
	  $this->load->helper(array('url'));
	  $this->load->model('evenement_model');
	  $this->load->model('Notification_model');
	  $this->load->model('Recherche_model');
	  $this->load->library('pagination');
	}

	function notify () {
 		$data = new stdClass();

 		if (isset($_GET['notify_id'])) {
 			$notify_id = $this->uri->segment(3);
			$this->Notification_model->vue_notify($notify_id);
 		}			

		$notifications = $this->Notification_model->count_notify();
		
		foreach ($notifications as $notification ) {
			$notification->event_notify = $this->Notification_model->notification();
		}

		$data->notifications = $notifications;

		$this->load->view('templates/header', $data);
	}

	function index() {
		$this->load->model('evenement_model');
		if ( isset( $_GET['search'] )) {
			$this->search_x();
		} else {
			if($this->input->post('addEvent')){
	    		if( !empty($this->input->post('titreEvent')) AND !empty($this->input->post('lieuEvent')) AND

	   			    !empty($this->input->post('descEvent')) AND !empty($this->input->post('datedebutEvent')) AND
	   			    !empty($this->input->post('datefinEvent')) AND !empty($this->input->post('pointDevente')) ) {
	   			    
	   			    // !empty($this->input->post('datefinEvent')) 
	    			 // AND !empty($this->input->post('prix'))

		    		// $photo = trim($this->input->post('photo'));
		    		$nom = trim($this->input->post('titreEvent'));
					$user_id = $this->session->userdata('idmembre');

		    		$lieuEvent = trim($this->input->post('lieuEvent'));
		    		$dateEvent = trim($this->input->post('dateEvent'));
		    		$descEvent = trim($this->input->post('descEvent'));

		    		$datedebutEvent = trim($this->input->post('datedebutEvent'));
		    		$datefinEvent = trim($this->input->post('datefinEvent'));
		    		$Activites = trim($this->input->post('activites'));
		    		$prix = trim($this->input->post('prix'));
		    		// $gratuit = trim($this->input->post('gratuit'));
		    		$pointDevente = trim($this->input->post('pointDevente'));
			
		    		$config['upload_path']      = 'assets/img/';
					$config['allowed_types']    = 'gif|jpg|png|jpeg|GIF|JPG|PNG|JPEG';
					$config['max_size']         = 2048;
					$config['max_width']        = 1024;
					$config['max_height']       = 1024;
					$config['file_ext_tolower'] = true;
					$config['encrypt_name']     = true;

					$this->load->library('upload', $config);
					$this->upload->initialize($config);

					if ( ! $this->upload->do_upload('userfile') ) {
						$error = array('error' => $this->upload->display_errors());
					}
					else {
						$data =  $this->upload->data();					
					}
					
					$data =  $this->upload->data();	
					$foto 	  = $data['file_name'];
					$this->evenement_model->add($nom,$user_id,$lieuEvent,$dateEvent,$descEvent, $datedebutEvent,$datefinEvent,$Activites,$prix,$pointDevente,$foto );

	    			$_SESSION['flash']['success'] = 'L\'evenement a été mise a jour.';
	    			$this->notify();
	    			// $this->load->view('templates/header');	  
					redirect('event/index'); 
	    		} else { 
	    			$_SESSION['flash']['danger'] = 'Veuille remplir tous les champs';
	    			$this->notify();
					// $this->load->view('templates/header');
					$this->load->view('evenement/index');
					$this->load->view('templates/footer');
				}
	    	} else {
	    			$this->notify();
	    		// $this->load->view('templates/header');
				$this->load->view('evenement/index');
				$this->load->view('templates/footer');
	    	}
	    }
	}

	function search_x(){
		$data = new stdClass();	
		if ($_GET['search']) {
			$search = $_GET['search'];
			$fetch = $this->Recherche_model->search($search); // var_dump($fetch);
			
			$data->fetch = $fetch;
			$this->notify();
			$this->load->view('search', $data); 
		} else {
			redirect('login/index');
		}
	}

	function enlever() {
		$idevenement = $_GET['idevenement'];
		$this->evenement_model->delete($idevenement);
		redirect('event/index');
	}

	// function modifier () {
	// 	$data = new stdClass();
	// 	$notifications = $this->evenement_model->count_notify();
		
	// 	foreach ($notifications as $notification ) {
	// 		$notification->event_notify = $this->evenement_model->notification();
	// 	}

	// 	$data->notifications = $notifications;

	// 	$this->load->view('templates/header');
	// 	$this->load->view('evenement/modifier', $data);
	// }



	// function likes() {
	// 	$like = 1; 
	// 	$idevent = $this->uri->segment(3);
	// 	// $req  = $this->evenement_model->likes($like);

	// 	$data  = new stdClass();
	// 	$likes = $this->evenement_model->liked($like, $idevent);
		
	// 	// foreach ($likes as $like ) {
	// 	// 	// $notification->event_likes = $this->evenement_model->likes();
	// 	// }

	// 	$data->likes = $likes;
	
	// 	$this->load->view('templates/header');
	// 	$this->load->view('evenement/index', $data); 
	// }

	 function modifier () {
	 	if ($this->input->post('addEvent')) {
	 		$col = $this->evenement_model->modifier_evenement(); 
	 	    redirect('event/index');
	 	}
	}
	function list_e () {
		$this->notify();
	 	$this->load->view('evenement/list');
	}

	function evenement_membre() {
		$req = $this->evenement_model->evenement_membre();
		if(!empty($req)){
			$this->notify();
			foreach ($req as $key ) {
				$data = array ( 
					'titre' => $key->titre 
				);
				$this->load->view('evenement/auteur_evenement', $data);
			}
		} else {
			// $this->notify();
			redirect('event/index');
		}
    }
}