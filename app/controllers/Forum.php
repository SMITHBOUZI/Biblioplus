<?php

class Forum extends CI_Controller {
	
	function index(){
		$this->load->view('templates/header');
		$this->load->view('forum/index');
	}

	public function nouveau_sujet(){
		$this->form_validation->set_rules('tsujet', 'Sujet', 'trim|required');
		$this->form_validation->set_rules('tcontenue', 'Contenue', 'trim|required');
		
		if($this->form_validation->run() === false){
			$this->load->view('templates/header');
			$this->load->view('forum/nouveau_sujet');
		}else{ 
			if($this->input->post('poster')){

				$ts = $this->input->post('tsujet');
			 /*	$fsu = $this->input->post('fsujet');
				$fsu = $this->input->post('fsujet'); */
				$tc = $this->input->post('tcontenue');

				$datestring = '%Y-%m-%d %h:%i:%s';
				$time = NOW();
				$td = mdate($datestring, $time); 

				if (strlen($ts) >= 90) {
					$_SESSION['flash']['info'] = "Le sujet ne doit pas de passe 10 caracteres !";
					$this->load->view('templates/header');
					$this->load->view('forum/nouveau_sujet');
				} else {
				    $user_id = $this->session->userdata('idmembre');
					$this->forum->nouveau_sujet($user_id, $ts, $tc, $td);
					// redirect('forum/index');
					$this->load->view('templates/header');
					$_SESSION['flash']['info'] = "Succés!";
					$this->load->view('forum/index');
				}
			}else{
				$this->load->view('templates/header');
				$this->load->view('forum/nouveau_sujet');
			}			 
		}
	}

	function view(){
		if ( (isset($_GET['s']) === true) && (isset($_GET['id']) === true) ) {
			$s   = $_GET['s'];
		    $id  = $_GET['id'];

			$req = $this->forum->get_sujet_by_id($s, $id);
			if ($req) {
				foreach ($req as $key ) {
					$data = array (
						'sujet'				 => $key->sujet,
						'contenu_c'			 => $key->contenu_c,
						'contenu_s'			 => $key->contenu_s,
						'date_hres_creation' => $key->date_hres_creation,
						'contenu_m' 		 => $key->contenu_m,
						'pseudo'			 => $key->pseudo
					);
				}
				$this->load->view('templates/header');
				$this->load->view('forum/discussions/view', $data);
			} else {
				$_SESSION['flash']['info'] = 'Desole aucun sujet trouver ';
				$this->load->view('templates/header');
				$this->load->view('forum/discussions/view');
			}
		} else if ( (isset($_GET['s']) === false) && (isset($_GET['id']) === false) ){
			
			$req = $this->forum->lister_sujet();
			if ($req) {
				foreach ($req as $key ) {
					$data = array (
						'sujet'				 => $key->sujet,
						'contenu_c'			 => $key->contenu_c,
						'contenu_s'			 => $key->contenu_s,
						'date_hres_creation' => $key->date_hres_creation,
						'contenu_m' 		 => $key->contenu_m,
						'pseudo'			 => $key->pseudo
					);
				}
				$this->load->view('templates/header');
				$this->load->view('forum/discussions/view', $data); 
			}		
		}
	}

	function comment(){
		// $id  = $_GET['id'];
		if ($this->input->post('post') ){
			if(empty($this->input->post('com_contenue')) && empty($this->input->post('id'))) {
				// $this->load->view('templates/header');
				$_SESSION['flash']['danger'] =  'Remplir';
				$this->load->view('forum/discussions/new'); 
			} else {
			// 	$this->load->view('templates/header');
				$r = $this->input->post('com_contenue');
				$u = $this->input->post('id');
				$req = $this->forum->comment($r, $u);
				if ($req) {
					$_SESSION['flash']['danger'] =  'Merci';
					$this->load->view('forum/discussions/new');
				} else {
					echo "NOt ";
				}
			}

		}


		$this->load->view('templates/header');
		// $_SESSION['flash']['danger'] =  'OKOOKKKKKKKOKOO';
		$this->load->view('forum/discussions/new'); 	
	}

	function cat(){
		$cat = $this->input->post('categorie');
		if ($cat) {
			$req = $this->forum->sujet_cat($cat);
			if ($req) {
				foreach ($req as $key) {
					$data = array(
						'sujet' 	=> $key->sujet,
						'contenu_c' => $key->contenu_c
					);
				}
			// $this->load->view('templates/header');
			// $this->load->view('forum/categories',$data);
			}
		}var_dump($data);
		$this->load->view('templates/header');
		$this->load->view('forum/categories',$data);
	}

}
 

			

		