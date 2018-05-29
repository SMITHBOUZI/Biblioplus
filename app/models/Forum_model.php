<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_model extends CI_Model {

	function nouveau_sujet($user_id, $ts, $tc){
		$cat = $this->input->post('categorie');

		$sql = 'SELECT * FROM f_categorie';
		$req = $this->db->query($sql);
		if ($req->num_rows()) {
			foreach ($req->result() as $key) {
				if ($key->contenu_c !== $cat ) {
					// return false;
				} else {
					$requte = 'INSERT INTO f_sujets ( `id_createur`, `id_categorie`, `sujet`, `contenu_s`, `date_hres_creation`) VALUES ( ?, ?, ?, ?, CURRENT_TIMESTAMP() )';
					$this->db->query($requte, array($user_id, $key->id, $ts, $tc ));

					$sql = 'SELECT * FROM f_sujets WHERE id = ? AND id_createur = ?';

					$sujet_id 	= $this->db->insert_id();
					$user_id 	= $this->session->userdata('idmembre');

					$req = $this->db->query($sql, array($sujet_id, $user_id));
					if($req->num_rows()){
						foreach ($req->result() as $key ) {
							$sujet_id = $key->id ;

							$query = "INSERT INTO `f_messages` ( `id_sujet`, `date_hres_post`) VALUES ( ?, CURRENT_TIMESTAMP() ) ";
							$req1 = $this->db->query($query, array($sujet_id));
						}
					}
				}
			}
		}
	}

	function lister_sujet(){	
		$sql = 'SELECT f_sujets.id, membre.pseudo, f_sujets.id_createur, f_sujets.sujet, f_sujets.contenu_s, f_sujets.date_hres_creation, f_categorie.contenu_c, f_messages.contenu_m FROM f_sujets INNER JOIN f_messages, f_categorie, membre WHERE membre.idmembre = f_sujets.id_createur AND f_sujets.id = f_messages.id_sujet  AND f_categorie.id = f_sujets.id_categorie GROUP BY f_messages.id DESC LIMIT 5 ';

		$req = $this->db->query($sql );

		if ($req->num_rows() === 1  ) {
			return $req->result();
		} else {
			// false;
			return $req->result();
		}
	}

	function sujet_cat($categorie_name){
		$sql = 'SELECT membre.pseudo, f_sujets.id_createur, f_sujets.sujet, f_sujets.contenu_s, f_sujets.date_hres_creation, f_categorie.contenu_c, f_messages.contenu_m FROM f_sujets INNER JOIN f_messages, f_categorie, membre WHERE membre.idmembre = f_sujets.id_createur AND f_sujets.id = f_messages.id_sujet  AND f_categorie.id = f_sujets.id_categorie AND f_categorie.contenu_c = ? GROUP BY f_messages.id DESC LIMIT 5 ';

		$req = $this->db->query($sql );

		if ($req->num_rows() === 1  ) {
			return $req->result();
		} else {
			// false;
			return $req->result();
		}
	}

	function get_sujet_admin(){
		$user_id = $this->session->userdata('idmembre'); 
		
		$sql = 'SELECT f_sujets.id, sujet, contenu_c, contenu_s, date_hres_creation FROM f_sujets INNER JOIN f_categorie WHERE f_categorie.id = f_sujets.id_categorie GROUP BY f_sujets.id DESC LIMIT 2 ';
		$req 	= $this->db->query($sql, array($user_id) );

		if ($req->num_rows()) {
			return $req->result();
		} else {
			// false;
			return $req->result() ;
		}
	}

	function get_sujet_cat(){
		$sql = 'SELECT * FROM f_categorie';
		$req 	= $this->db->query($sql );

		if ($req->num_rows()) {
			return $req->result();
		} else {
			// false;
			return $req->result() ;
		}
	}

	function get_sujet_by_id($s, $id){
		// $sql = 'SELECT sujet, contenu_c, contenu_s, date_hres_creation FROM f_sujets INNER JOIN f_messages, f_categorie WHERE sujet = ? AND f_sujets.id = ? AND f_sujets.id = f_messages.id_sujet  AND f_categorie.id = f_sujets.id_categorie  ';
		$sql = 'SELECT membre.pseudo, f_sujets.sujet, f_categorie.contenu_c, f_sujets.contenu_s, f_sujets.date_hres_creation, f_messages.contenu_m FROM f_sujets 
		INNER JOIN f_messages, f_categorie, membre WHERE sujet = ? 
		AND f_sujets.id = ? AND f_sujets.id = f_messages.id_sujet 
		AND f_categorie.id = f_sujets.id_categorie AND membre.idmembre = f_sujets.id_createur  ';
		$req = $this->db->query($sql, array( $s, $id ) );

		// $com = $this->input->post('comment');
		
		if ($req->num_rows() === 1 ) {
			return $req->result_object();
		}else {
			// false;
			return $req->result_object();
		}
	}

	function update($user_id, $ts, $tc){
		$cat = $this->input->post('categorie');

		$sql = 'SELECT * FROM f_categorie';
		$req = $this->db->query($sql);
		if ($req->num_rows()) {
			foreach ($req->result() as $key) {
				if ($key->contenu_c != $cat ) {
					echo 'Categorie differente';
				} else {

					$requte = 'UPDATE f_sujets SET `id_createur` = ?, `id_categorie` = ?, `sujet` = ?, `contenu_s` = ?, `date_hres_creation` = CURRENT_TIMESTAMP() )';
					$this->db->query($requte, array($user_id, $key->id, $ts, $tc ));

					$sql = 'SELECT * FROM f_sujets WHERE id = ? AND id_createur = ?';

					$sujet_id 	= $this->db->insert_id();
					$user_id 	= $this->session->userdata('idmembre');

					$req = $this->db->query($sql, array($sujet_id, $user_id));
					if($req->num_rows()){
						foreach ($req->result() as $key ) {
							var_dump($key);
							// update dans f_categorie
							$sujet_id  = $key->id ;
							$post_date = $key->date_hres_creation ;

							$query = "UPDATE `f_messages` SET `id_sujet` = ?, `date_hres_post` = ?, `date_hres_edition` = CURRENT_TIMESTAMP() ) ";
							$req1 = $this->db->query($query, array($sujet_id, $post_date));
						}
					}
				}
			}
		}
	}

	// UPDATE f_messages SET id_sujet = 1 , date_hres_edition = NOW(), contenu_m = 'Lolo'
	function comment($id_sujet, $cm) {		
		// $cm = $this->input->post('tcontenue');

		$user_id = $this->session->userdata('idmembre');
	 	$sql = "UPDATE f_messages SET date_hres_edition = NOW(), contenu_m = ? , id_poster_comment = ? WHERE id_sujet = ? ";

	 	$this->db->query($sql, array($cm, $user_id, $id_sujet));
	}
}