<?php

class Forum extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
		$this->load->model('forum_model');
	}
	
	function index(){
		// create the data object
		$data = new stdClass();
		// create objects
		$forums = $this->forum_model->get_forums();

		foreach ($forums as $forum) {
				
			// $forum->permalink    = base_url($forum->slug);
			$forum->topics       = $this->forum_model->get_forum_topics($forum->id);
			$forum->topics_cat   = $this->forum_model->get_topic_cat($forum->id_categorie);
			$forum->topics_mem   = $this->forum_model->get_topic_mem($forum->id_createur);
			$forum->count_topics = count($forum->topics);
			$forum->count_posts  = $this->forum_model->count_forum_posts($forum->id); // var_dump($forum->count_posts);
			
			if ($forum->count_topics > 0) {
				
				// $forum has topics
				$forum->latest_topic            = $this->forum_model->get_forum_latest_topic($forum->id);
				// $forum->latest_topic->permalink = $forum->slug . '/' . $forum->latest_topic->slug;
				// $forum->latest_topic->author    = $this->user_model->get_username_from_user_id($forum->latest_topic->user_id);
				
			} else {
				
				// $forum doesn't have topics yet
				$forum->latest_topic = new stdClass();
				$forum->latest_topic->permalink = null;
				$forum->latest_topic->title = null;
				$forum->latest_topic->author = null;
				$forum->latest_topic->created_at = null;
				
			}
	
		}
		
		// assign created objects to the data object
		$data->forums     = $forums;
		
		// load views and send data
		$this->load->view('templates/header');
        $this->load->view('forum/index', $data);
	}

	public function nouveau_sujet(){
		$this->load->helper('form');
		$this->load->library('form_validation');

		$this->form_validation->set_rules('tsujet', 'Sujet', 'trim|required');
		$this->form_validation->set_rules('tcontenue', 'Contenue', 'trim|required');
		
		if($this->form_validation->run() === false){
			$this->load->view('templates/header');
			$this->load->view('forum/nouveau_sujet');
		}else{ 
			if($this->input->post('poster')){

				$ts = $this->input->post('tsujet'); 
				$tc = $this->input->post('tcontenue');
 
				if (strlen($ts) >= 90) {
					$_SESSION['flash']['info'] = "Le sujet ne doit pas dépasser 90 caracteres !";
					$this->load->view('templates/header');
					$this->load->view('forum/nouveau_sujet');
				} else {
				    $user_id = $this->session->userdata('idmembre');
					$this->forum_model->nouveau_sujet($user_id, $ts, $tc);
					redirect('forum/index');
					// $this->load->view('templates/header');
					// $_SESSION['flash']['info'] = "Succés!";
					// $this->load->view('forum/index');
				}
			}else{
				$this->load->view('templates/header');
				$this->load->view('forum/nouveau_sujet');
			}			 
		}
	}

	function view() {
		// create the data object
		$data = new stdClass();
		$this->load->helper('form');

		$s = $this->uri->segment(3);
		$id = $this->uri->segment(4);		

		// create objects
		$forums = $this->forum_model->get_forums(); // var_dump($forums);

		foreach ($forums as $forum) {
			// $forum->sujet_post = $this->forum_model->get_forum_id_from_forum_f_msg($forum->id_categorie); // var_dump($forum->sujet_post);
			// $forum->sujet = $this->forum_model->get_topic_id_from_topic_f_sujet($forum->id);
			$forum->sujet_post = $this->forum_model->fetch_forum_posts($forum->id);
		}


		$data->forums = $forums;
		// load views and send data
		$this->load->view('templates/header');
        $this->load->view('forum/discussions/view', $data);

	}

	function comment (){

		if ($this->input->post('poster')) {
			if (!empty($this->input->post('tcontenue')) ) {
				$cm = $this->input->post('tcontenue');
				$id = $this->input->post('id');

				$req = $this->forum_model->comment($id, $cm);
				
				// $this->load->view('templates/header');
				// $this->load->view('forum/index'); 
				header('Location:view');
			} else {
				
				$_SESSION['flash']['info'] = 'Saisir le comment ';
				// $this->load->view('forum/index');
				header('Location:view');				
			}				
		}
	} 

}

			

		