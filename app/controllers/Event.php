<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

	function __construct(){
	  parent::__construct();
	  $this->load->library(array('session'));
	  $this->load->helper(array('url'));
	  $this->load->model('evenement_model');

	}

	function index() {
		if($this->input->post('addEvent')){
    		if( !empty($this->input->post('titreEvent')) AND !empty($this->input->post('lieuEvent')) AND
    			 !empty($this->input->post('descEvent')) AND

    			!empty($this->input->post('datedebutEvent')) AND !empty($this->input->post('datefinEvent')) AND
    			!empty($this->input->post('Activites')) AND !empty($this->input->post('prix')) AND 
    			!empty($this->input->post('pointDevente')) ) {

	    		// $photo = trim($this->input->post('photo'));
	    		$nom = trim($this->input->post('titreEvent'));
				$user_id = $this->session->userdata('idmembre');

	    		$lieuEvent = trim($this->input->post('lieuEvent'));
	    		$dateEvent = trim($this->input->post('dateEvent'));
	    		$descEvent = trim($this->input->post('descEvent'));

	    		$datedebutEvent = trim($this->input->post('datedebutEvent'));
	    		$datefinEvent = trim($this->input->post('datefinEvent'));
	    		$Activites = trim($this->input->post('Activites'));
	    		$prix = trim($this->input->post('prix'));
	    		$pointDevente = trim($this->input->post('pointDevente'));


	    		$config['upload_path']          = 'assets/avatar/';
				$config['allowed_types']        = 'gif|jpg|png|jpeg';
				$config['max_size']             = 0;
				$config['max_width']            = 180;
				$config['max_height']           = 240;

				$this->load->library('upload', $config);
				$this->upload->initialize($config);

				if ( ! $this->upload->do_upload('userfile') )
				{
					// $_SESSION['flash']['danger'] = 'l\'images n\'a pas pu etre upload il faut un format : gif | jpg | png | jpeg ' ;
					$error = array('error' => $this->upload->display_errors());
				}
				else
				{
					// $data = array('upload_data' => $this->upload->data());
					$data =  $this->upload->data();					
				}
				if (!empty($data)) {
				    $this->evenement_model->add($data);
				}else {
	    		$req = $this->evenement_model->add($nom,$user_id,$lieuEvent,$dateEvent,$descEvent, $datedebutEvent,$datefinEvent,$Activites,$prix,$pointDevente );
				}
	    			$_SESSION['flash']['success'] = 'L\'evenement a ete mise a jour.';
	    			$this->load->view('templates/header');
					$this->load->view('evenement/index');
					$this->load->view('templates/footer');	  
					// redirect('evenement/lister');  
    		} else { 
    			$_SESSION['flash']['danger'] = 'Veuille remplir tous les champs';
				$this->load->view('templates/header');
				$this->load->view('evenement/index');
				$this->load->view('templates/footer');
			}
    	} else {
    		$this->load->view('templates/header');
			$this->load->view('evenement/index');
			$this->load->view('templates/footer');
    	}
		
	}

    function ajouter()	{
   //  	if($this->input->post('addEvent')){
   //  		if( !empty($this->input->post('titreEvent')) AND !empty($this->input->post('lieuEvent')) AND
   //  			!empty($this->input->post('dateEvent')) AND !empty($this->input->post('descEvent')) AND

   //  			!empty($this->input->post('datedebutEvent')) AND !empty($this->input->post('datefinEvent')) AND
   //  			!empty($this->input->post('Activites')) AND !empty($this->input->post('prix')) AND 
   //  			!empty($this->input->post('prix')) ) {

	  //   		// $photo = trim($this->input->post('photo'));
	  //   		$nom = trim($this->input->post('titreEvent'));
			// 	$user_id = $this->session->userdata('idmembre');

	  //   		$lieuEvent = trim($this->input->post('lieuEvent'));
	  //   		$dateEvent = trim($this->input->post('dateEvent'));
	  //   		$descEvent = trim($this->input->post('descEvent'));

	  //   		$datedebutEvent = trim($this->input->post('datedebutEvent'));
	  //   		$datefinEvent = trim($this->input->post('datefinEvent'));
	  //   		$Activites = trim($this->input->post('Activites'));
	  //   		$prix = trim($this->input->post('prix'));
	  //   		$pointDevente = trim($this->input->post('pointDevente'));


	  //   		$config['upload_path']          = 'assets/avatar/';
			// 	$config['allowed_types']        = 'gif|jpg|png|jpeg';
			// 	$config['max_size']             = 0;
			// 	$config['max_width']            = 180;
			// 	$config['max_height']           = 240;

			// 	// $this->load->library('upload', $config);
			// 	$this->upload->initialize($config);

			// 	if ( ! $this->upload->do_upload('userfile') )
			// 	{
			// 		// $_SESSION['flash']['danger'] = 'l\'images n\'a pas pu etre upload il faut un format : gif | jpg | png | jpeg ' ;
			// 		$error = array('error' => $this->upload->display_errors());
			// 	}
			// 	else
			// 	{
			// 		// $data = array('upload_data' => $this->upload->data());
			// 		$data =  $this->upload->data();					
			// 	}
			// 	if (!empty($data)) {
			// 	    $this->evenement_model->add($data);
			// 	}else {
	  //   		$req = $this->evenement_model->add($nom,$user_id,$lieuEvent,$dateEvent,$descEvent, $datedebutEvent,$datefinEvent,$Activites,$prix,$pointDevente );
			// 	}
	  //   			$_SESSION['flash']['success'] = 'L\'evenement a ete mise a jour.';
	  //   			$this->load->view('templates/header');
			// 		$this->load->view('evenement/index');	  
			// 		// redirect('evenement/lister');  
   //  		} else { 
   //  			$_SESSION['flash']['danger'] = 'Veuille remplir tous les champs';
			// 	$this->load->view('templates/header');
			// 	$this->load->view('evenement/ajouter');
			// }
   //  	} else {
   //  		$this->load->view('templates/header');
			// $this->load->view('evenement/ajouter');
   //  	}
	}

	// function lister() {
	// 	$req = $this->event->lister();
	// 	if ($req) {
	// 		foreach ($req as $key) {
	// 			$data = array(
	// 				'photo'  		 => $key->photo,
	// 				'nom'    		 => $key->nom,
	// 				'lieuEvenement'  => $key->lieuEvenement,
	// 				'dateEvenement'  => $key->dateEvenement,
	// 				'description'    => $key->description,
	// 				'pseudo'    	 => $key->pseudo
	// 			);
	// 		}
	// 		$this->load->view('templates/header');
	// 		$this->load->view('evenement/lister',$data);
	// 	} else {
	// 		echo 'pas de nouvelle evenement ';
	// 	}
	// }

	function ficheEvenement()	{
		$this->load->view('templates/header');
		$this->load->view('evenement/ficheEvenement');
	}

	function modifier()	{
		$this->load->view('templates/header');
		$this->load->view('evenement/modifier');
	}

	function enlever()	{
		$this->load->view('templates/header');
		$this->load->view('evenement/suprimer');
	}

}