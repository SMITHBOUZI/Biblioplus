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

		$nom = $this->input->post('nom_prenom');
		$sex = $this->input->post('sexe');
		$dat = $this->input->post('date_naissance');
		$pseu = $this->input->post('pseudo');
		$pass = sha1($this->input->post('mot_de_passe'));	
		$ema = $this->input->post('email'); 
		$sta = $this->input->post('mem');
		$desc = $this->input->post('desc');
		
		$co = $this->security->get_csrf_hash();
		$to = $this->input->post('token_confirmed');
		$pho = $this->upload->file_name;

		$data = array(
			'idinscription'		=> '',
			'nom_prenom' 	 	=> $nom,
			'sexe' 			 	=> $sex,
			'date_naissance' 	=> $dat,
			'pseudo'		 	=> $pseu,
			'mot_de_passe' 	 	=> $pass,
			'email'   		 	=> $ema,
			'status'			=> $sta,
			'description'		=> $desc,

			'token_confirmed'	=> $to,
			'confirm_token' 	=> $co,
			'photo'				=> $pho				
		);
		$this->db->insert('inscription', $data);
	}	
}