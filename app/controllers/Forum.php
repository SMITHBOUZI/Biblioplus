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

}
 

			

		