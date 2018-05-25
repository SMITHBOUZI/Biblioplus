<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auteur extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function lister() {
		$this->load->view('templates/header');
		$this->load->view('auteur/lister');
	}
}