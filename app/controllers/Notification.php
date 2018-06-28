<?php 
 /**
 * 
 */
 class Notification extends CI_Controller {
 	
 	function __construct() {
 		parent::__construct();
 		$this->load->model('Notification_model');
 		$this->load->library(array('session'));
		$this->load->helper(array('url'));
 	}

 	function index () {
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
		$this->load->view('templates/notif');
		// $this->load->view('evenement/modifier', $data); 
	}

	// function page() {
 
 //       $config = array();
 
 //       $config["base_url"] = base_url() . "auteur/page";
 
 //       $config["total_rows"] = $this->Auteur_model->record_count();
 
 //       $config["per_page"] = 1;
 
 //       $config["uri_segment"] = 3;
 
 //       $this->pagination->initialize($config);
 
 //       $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 
 //       $data["results"] = $this->Auteur_model->fetch_departments($config["per_page"], $page);
 
 //       $data["links"] = $this->pagination->create_links();
 
	// 	// $this->load->view('templates/header');
 //       $this->load->view("evenement/Test");
	// 	// $this->load->view('templates/footer', $data);
 //  //    $this->load->view("auteur/index");
 //    }
 }