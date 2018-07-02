<?php

class Forum extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('forum_model');
		$this->load->model('Notification_model');
		$this->load->model('login_model');
		$this->load->model('Recherche_model');
	}

	function notify () {
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
	}
	
	function index(){
		if ( isset( $_GET['search'] ) ) {
  			$this->search_x();
 		} else {
			$data = new stdClass();
			$forums = $this->forum_model->get_forums();

			foreach ($forums as $forum) {
					
				$forum->topics       = $this->forum_model->get_forum_topics($forum->id);
				$forum->topics_cat   = $this->forum_model->get_topic_cat($forum->id_categorie);
				$forum->topics_mem   = $this->forum_model->get_topic_mem($forum->idmembre);
				$forum->count_topics = count($forum->topics);
				$forum->count_posts  = $this->forum_model->count_forum_posts($forum->id);
					
			}
			
			$data->forums     = $forums;
			$this->notify();
			// $this->load->view('templates/header');
	        $this->load->view('forum/index', $data);
	        $this->load->view('templates/footer');
	    }
	}

	function cat_valide(){
		if ( (trim($this->input->post('categorie')) === 'Categorie') ){
			return FALSE;
		} else {
			return TRUE ;
		}
    }

	public function nouveau_sujet(){
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('tsujet', 'Sujet', 'trim|required');
		$this->form_validation->set_rules('categorie', 'Categorie', 'trim|required|callback_cat_valide');
		$this->form_validation->set_rules('tcontenue', 'Contenue', 'trim|required');
		
		if($this->form_validation->run() === false){
			// $this->load->view('templates/header');
			$this->notify();
			$this->load->view('forum/index');
		}else{ 
			if($this->input->post('poster')){
				if( !empty($this->input->post('tsujet')) AND !empty($this->input->post('tsujet')) ) {
					$ts = htmlspecialchars_decode($this->input->post('tsujet')); 
					$tc = htmlspecialchars_decode($this->input->post('tcontenue'));
	 
					if (strlen($ts) >= 90) {
						$_SESSION['flash']['info'] = "Le sujet ne doit pas dépasser 90 caracteres !";
						// $this->load->view('templates/header');
						$this->notify();
						$this->load->view('forum/index');
					} else {
					    $user_id = $this->session->userdata('idmembre');
						$this->forum_model->nouveau_sujet($user_id, $ts, $tc);
						$_SESSION['flash']['success'] = "Succés!";
						redirect('forum/index');
					}
				} 'Veuillez remplir tous les champs';
			}else{
				// $this->load->view('templates/header');
				$this->notify();
				$this->load->view('forum/index');
				$this->load->view('templates/footer');
			}			 
		}
	}

	function view() {
		$data = new stdClass();
		$this->load->helper('form');

		// $s  = htmlentities($this->uri->segment(3));
		// $id = htmlentities($this->uri->segment(4));

		$s  = $_GET['s'];
		$id = $_GET['id'];		


		$forums = $this->forum_model->fetch_forum_posts($id);

		foreach ($forums as $forum) {
			$forum->sujet_membre = $this->forum_model->get_topic_mem($forum->idmembre);
			$forum->sujet_valid = $this->forum_model->sujet_valid($id, $forum->sujet);

			$forum->sujet_info = $this->forum_model->get_forums();  
			$forum->sujet_post = $this->forum_model->get_topic_post($id); 
		}

		$data->forums = $forums;

		// $this->load->view('templates/header');
		$this->notify();
        $this->load->view('forum/discussions/view', $data);
        $this->load->view('templates/footer');
        // $this->load->view('templates/footer');
	}

	function comment (){

		if ($this->input->post('poster')) {
			if (!empty($this->input->post('tcontenue')) ) {
				$cm = htmlspecialchars($this->input->post('tcontenue'));
				$id = htmlspecialchars($this->input->post('id'));

				$req = $this->forum_model->comment($id, $cm);

				header('Location:view?s='.$cm.'&id='.$id);
			} else {				
				$_SESSION['flash']['info'] = 'Saisir le comment svp';
				header('Location:view');
			}
		}
	}

	function forum_membre() {
		$req = $this->forum_model->forum_membre();
		if(!empty($req)){
			$this->notify();
			foreach ($req as $key ) {
				$data = array ( 
					'sujet' => $key->sujet 
				);
				$this->load->view('forum/membre_sujet', $data);
			}
		} else {
			// $this->notify();
			redirect('forum/index');
		}
    }

    function search_x(){
		$data = new stdClass();	
		if ($_GET['search']) {
			$search = $_GET['search'];
			$fetch = $this->Recherche_model->search($search);
			
			$data->fetch = $fetch;
			$this->notify();
			$this->load->view('search', $data); 
		} else {
			redirect('login/index');
		}
	}
}

			

		