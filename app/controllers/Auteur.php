<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auteur extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Auteur_model');
		$this->load->helper(array('url'));
		$this->load->library(array('session'));
	}

	function lister() {
		$this->load->view('templates/header');
		$this->load->view('auteur/lister');
	}
}