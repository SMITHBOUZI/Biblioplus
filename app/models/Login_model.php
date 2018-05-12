<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	function sign_in($pseudo, $pass){
		
		$this->db->select('*');
		$this->db->from('membre');
		$this->db->where('pseudo', $pseudo);
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		}else{
			return false;
		}
	}

	function check_if_pseudo_exists($pseudo){

		$this->db->WHERE('pseudo', $pseudo);
		$req = $this->db->get('inscription');
		if ($req->num_rows() > 0) {
			# code...
			return false;
		}else {
			return true;
		}
    }

    function check_if_email_exists($email){
    	$this->db->WHERE('email', $email);
		$req = $this->db->get('inscription');
		if ($req->num_rows() > 0) {
			# code...
			return false;
		}else {
			return true;
		}    	
    }

	function sign_up(){
		$sql = 'SELECT * FROM reponse';
		$req = $this->db->query($sql);
		if ($req->num_rows() === 1) {
			$rep = $this->input->post('reponse');
			$rep_x = $this->input->post('reponse_x');
			$mem = $this->input->post('membre');
			//if ($mem == 'membre') {
				# code...
			
				foreach ($req as $row ) {
					if ( ($row->reponse === $req) AND ($row->reponse_x === $req_x)) {
						# code...
						$no = $this->input->post('nom');
						$pr = $this->input->post('prenom');
						$se = $this->input->post('sexe');
						$dt = $this->input->post('date_naissance');
						$ps = $this->input->post('pseudo');
						$pw = sha1($this->input->post('password'));	
						// $pw =  $this->input->post('mot_de_passe');	
						// $pw = password_hash(trim($this->input->post('mot_de_passe')), PASSWORD_BCRYPT);	
						$em = $this->input->post('email');

						// $rep = $this->input->post('reponse');
						// $rep_x = $this->input->post('reponse_x');
						$dep = $this->input->post('departement');
						$mem = $this->input->post('membre');
						
						$co = $this->security->get_csrf_hash();
						$to = $this->input->post('token_confirmed');
						$pho = $this->upload->file_name;

						$data = array(
							'idinscription'		=> '',
							'nom' 			 	=> $no,
							'prenom' 		 	=> $pr,
							'sexe' 			 	=> $se,
							'date_naissance' 	=> $dt,
							'pseudo'		 	=> $ps,
							'mot_de_passe' 	 	=> $pw,
							'email'   		 	=> $em,

							'status'			=> $mem,
							// 'reponse'			=> $rep,
							// 'reponse-x'			=> $rep_x,
							'departement'		=> $dep,
							// 'membre'				=> $mem,
							// 'code_postal'		=> $cop,
							'token_confirmed'	=> $to,
							'confirm_token' 	=> $co,
							'photo'				=> $pho				
						);
						$this->db->insert('inscription', $data);
					}
				}
			// }
		}	
	}	
}