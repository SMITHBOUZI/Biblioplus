<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collection extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

    function ajouter()	{
    	if( !empty($this->input->post('titre')) ) {
    		$nom = trim($this->input->post('nom'));
    		$req = $this->event->add($nom);
    		if ($req) {
    			$_SESSION['flash']['success'] = 'L\'evenement a ete mise a jour.'
    			$this->load->view('templates/header');
				$this->load->view('collection/ajouter');
    		}
    	}
		$this->load->view('templates/header');
		$this->load->view('collection/ajouter');
	}

	function modifier()	{
		$this->load->view('templates/header');
		$this->load->view('collection/modifier');
	}

	function enlever()	{
		$this->load->view('templates/header');
		$this->load->view('collection/suprimer');
	}
}