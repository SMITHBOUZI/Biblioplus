<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil_user extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function affichage() {
		$this->load->view('templates/header');
		$this->load->view('profil_user');
		// $this->load->view('templates/footer');
	}
}