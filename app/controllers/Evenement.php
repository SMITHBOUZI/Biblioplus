<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evenement extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

    function ajouter()	{
    	if( !empty($this->input->post('nom')) ) {

    		// $photo = trim($this->input->post('photo'));
    		$nom = trim($this->input->post('nomEvent'));
 			$user_id = $this->db->insert_id();
    		$lieuEvent = trim($this->input->post('lieuEvent'));
    		$dateEvent = trim($this->input->post('dateEvent'));

    		$config['upload_path']          = 'assets/avatar/';
			$config['allowed_types']        = 'gif|jpg|png|jpeg';
			$config['max_size']             = 0;
			$config['max_width']            = 180;
			$config['max_height']           = 240;

			// $this->load->library('upload', $config);
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
			    $this->event->add($data);
			}else {
    		$req = $this->event->add($nom,$user_id,$lieuEvent,$dateEvent );
			}
    		
    		// $req = $this->event->add($photo,$nom,$user_id,$lieuEvent,$dateEvent );
    		if ($req) {
    			$_SESSION['flash']['success'] = 'L\'evenement a ete mise a jour.';
    			$this->load->view('templates/header');
				$this->load->view('evenement/ajouter');
    		}
    	}
		$this->load->view('templates/header');
		$this->load->view('evenement/ajouter');
	}

	function lister() {
		$req = $this->event->lister();
		if ($req) {
			foreach ($req as $key) {
				$data = array(
					'photo'  => $key->photo,
					'nom'  => $key->nom,
					'lieuEvenement'  => $key->lieuEvenement,
					'dateEvenement'  => $key->dateEvenement
				);
			}
		}
		$this->load->view('templates/header');
		$this->load->view('evenement/lister', $data);
	}

	function modifier()	{
		$this->load->view('templates/header');
		$this->load->view('evenement/modifier');
	}

	function enlever()	{
		$this->load->view('templates/header');
		$this->load->view('evenement/suprimer');
	}

	   function nouveau_evenement()	{
		$this->load->view('templates/header');
		$this->load->view('nouveau_evenement');
	}
}