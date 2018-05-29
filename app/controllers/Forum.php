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
		// $id  = $_GET['id'];
		if ($_GET['id'] === true ) {
			echo "Id on";
		}
		// if ($this->input->post('poster')) {
		//     // $id  = $_GET['id'];
		// 	echo "Franck .."; 
		// 	$cm = $this->input->post('tcontenue'); 
		// 	$req = $this->forum->comment($id, $cm);
		// }		
	}

	// function comment (){
	// 	$id_sujet  = $_GET['id'];
	// 	$contenu_m = $this->input->post('contenu_m'); 
	// 	$req = $this->forum->comment($id_sujet, $contenu_m);
		
	// 	if ($req) {
	// 		echo "comment added";
	// 	} else {
	// 		echo "Error de comment ";
	// 	}
	// }

}

			

		