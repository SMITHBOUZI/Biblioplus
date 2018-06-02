<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collection extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

    function collection()	{
		$this->load->view('templates/header');
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
	}
}