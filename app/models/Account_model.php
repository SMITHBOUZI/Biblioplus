<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {	

 	function check_for_like($get_t, $get_id){
 		
 		$sql = "SELECT idmembre FROM membre WHERE idmembre = ? ";
 		$req = $this->db->query($sql, array($get_id));

 		if ($req->num_rows() == 1) {
 			if ($get_t == 1) {
 				$sql = "INSERT INTO likes (idmembre) value (?) ";
 				$this->db->query($sql, array($get_id));
 			}else if($get_t == 2){
 				$sql = "INSERT INTO dislikes (idmembre) value (?) ";
 				$this->db->query($sql, array($get_id));
 			}
 		}
	}

	function search_bar($search){
		if ($search) {
			// SELECT * FROM inscription WHERE nom_prenom LIKE 'b%' OR pseudo LIKE 'd%'  // LIKE "b%" OR nom_prenom LIKE "b%" 
			$sql = 'SELECT * FROM inscription WHERE pseudo = ? ';
			$query = $this->db->query($sql, array($search));

			if ($query->num_rows() === 1 ) {
				return $query->result_object();
			} else {
				echo "Data not found ..";
				return false;
			}
		}
	}

	function fetch($user_id){
		$sql = "SELECT * FROM membre WHERE idmembre = ? ";
		$req = $this->db->query($sql, array($user_id));
		if ($req->num_rows() === 1) {
			return $req->result();
		}else {
			return false;
		}
	}

    function confirmation(){
    	$user_id = $_GET['id'];
		$token	 = $_GET['token'];

		$req = $this->db->SELECT('*');
		$req = $this->db->from('inscription');
		$req = $this->db->where('idinscription', $user_id);
		$req = $this->db->get();

		if($req->num_rows() === 1){

			foreach ($req->result() as $user) {
				if ($user && $user->confirm_token == $token) {
					$this->db->query('UPDATE inscription SET confirm_token = NULL, token_confirmed = NOW() WHERE idinscription ='. $user_id);

					$data = array(
						'idmembre' 		=> '', 
						'pseudo' 		=> $user->pseudo,
						'photo' 		=> $user->photo,
						
						'mot_de_passe'  => $user->mot_de_passe,
						'email' 		=> $user->email
						);
					$this->db->insert('membre', $data);
				}else{
					// echo "pas ok";
				}				
			}	
			return $req->result_object();
		}else{
			return false;
		}
    }

    function password_fotgot($email, $reset_token){
		$req = $this->db->SELECT('*');
		$req = $this->db->from('membre');
		$req = $this->db->where('email', $email);
		$req = $this->db->get();

		if($req->num_rows() == 1){
			
			foreach ($req->result() as $user) {
				if ($user && $user->email === $email) {
					$sql = 'UPDATE membre SET reset_token = ? WHERE email = ?';
					$this->db->query($sql, array($reset_token ,$email) );
				}else{
					// echo "pas ok";
				}				
			}	
			return $req->result_object();
		}else{
			 return false;
		}
	} 

	function password_reset( $reset_token){
 	
		$req = $this->db->SELECT('*');
		$req = $this->db->from('membre');
		$req = $this->db->where('reset_token', $reset_token);
		$req = $this->db->get();

		if($req->num_rows() === 1){	
			return $req->result_object();
		}else{
			// echo "Token invalid !!";
			return false;
		}
	} 

	function update_pass($mot_de_passe){

		$query = "UPDATE membre SET reset_token = NULL, reset_token_at = NOW(), mot_de_passe = ? ";
		$req = $this->db->query($query, array($mot_de_passe));

		if ($req) {
			return true;
		}else {
			return false;
		}
	}

	function form_uploaded_doc($data){
		$cat 	= $this->input->post('categorie');
		$tr 	= $this->input->post('titre');
		$is 	= $this->input->post('isbn');
		$pages  = $this->input->post('pages');
		$file   = $this->upload->file_name;
		
		$data = array(
			'idouvrage'		=> '',
			'categorie' 	=> $cat,
			'titre' 		=> $tr,
			'isbn' 			=> $is,
			'nombrePage'	=> $pages,
			'file_name'		=> $file
		);
		$this->db->insert('ouvrage', $data);
	}

	// function get_livres(){
	// 	$sql = 'SELECT * FROM inscription';
	// 	$req = $this->db->query($sql);
	// 	// var_dump($req);

	// 	if ($req->num_rows() == 1) {
	// 		echo "OK";
	// 		return $req->result();
	// 	} else {
	// 		echo "Pas bon ";
	// 		return false;
	// 	}
	// }

	function profil_up($pseudo, $email){
		$query = $this->session->get_userdata('logged_in');
		$idmembre = $query['idmembre'];

		$req = " UPDATE membre SET pseudo = ?, email = ? WHERE idmembre = ? ";
		$sql =  $this->db->query($req, array($pseudo, $email, $idmembre));


    }
}