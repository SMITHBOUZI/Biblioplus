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
    			$_SESSION['flash']['success'] = 'L\'evenement a ete mise a jour.';
    			$this->load->view('templates/header');
				$this->load->view('collection/ajouter');
    		}
    	}
		$this->load->view('templates/header');
<<<<<<< HEAD
		$this->load->view('collection');
		$this->load->view('templates/footer');
	}

	function ouvrage()	{
		$this->load->view('templates/header');
		$this->load->view('templates/ouvrage');
		 $this->load->view('templates/footer');
	}

	function auteurs()	{
		$this->load->view('templates/header');
		$this->load->view('auteurs');
		 $this->load->view('templates/footer');
=======
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

	function lister(){
		$this->load->view('templates/header');
		$this->load->view('collection/lister');
>>>>>>> c802d5d17295ec8efe74388ec1606319e938dfc9
	}
}