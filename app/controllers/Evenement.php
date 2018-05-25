<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Evenement extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

    function evenement()	{
		$this->load->view('templates/header');
		$this->load->view('evenement');
	}

	   function nouveau_evenement()	{
		$this->load->view('templates/header');
		$this->load->view('nouveau_evenement');
	}
}