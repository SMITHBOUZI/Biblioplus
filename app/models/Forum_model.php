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
					// if($req->num_rows()){
					// 	foreach ($req->result() as $key ) {
					// 		$sujet_id = $key->id ;

					// 		$query = "INSERT INTO `f_messages` ( `id_sujet`, `date_hres_post`) VALUES ( ?, CURRENT_TIMESTAMP() ) ";
					// 		$req1 = $this->db->query($query, array($sujet_id));
					// 	}
					// }
				}
			}
		}
	}

	// function count(){
	// 	$sql = 'SELECT   COUNT(contenu_m) as rep from f_messages GROUP by id_poster_comment LIMIT 5';
	// 	$req = $this->db->query($sql);

	// 	if ($req->num_rows() > 0) {
	// 		return $req->result_object();
	// 	} else {
	// 		return false;
	// 	}
	// }
	// SELECT DATE_FORMAT(f_sujets.date_hres_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_hres_creation, f_sujets.id, membre.pseudo, f_sujets.id_createur, f_sujets.sujet, f_sujets.contenu_s, f_categorie.contenu_c FROM f_sujets INNER JOIN f_categorie, membre WHERE  membre.idmembre = f_sujets.id_createur AND f_categorie.id = f_sujets.id_categorie GROUP BY f_sujets.id DESC LIMIT 5

// SELECT DATE_FORMAT(f_sujets.date_hres_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_hres_creation ,COUNT(contenu_m) as rep, f_sujets.id, membre.pseudo, f_sujets.id_createur, f_sujets.sujet, f_sujets.contenu_s, f_categorie.contenu_c, f_messages.contenu_m FROM f_sujets INNER JOIN f_messages, f_categorie, membre WHERE membre.idmembre = f_sujets.id_createur AND f_sujets.id = f_messages.id_sujet  AND f_categorie.id = f_sujets.id_categorie GROUP BY f_messages.id DESC LIMIT 5 

	function lister_sujet(){	
		$sql = "SELECT DATE_FORMAT(f_sujets.date_hres_creation, '%d/%m/%Y à %Hh%imin%ss') AS date_hres_creation, f_sujets.id, membre.pseudo, f_sujets.id_createur, f_sujets.sujet, f_sujets.contenu_s, f_categorie.contenu_c FROM f_sujets INNER JOIN f_categorie, membre WHERE  membre.idmembre = f_sujets.id_createur AND f_categorie.id = f_sujets.id_categorie GROUP BY f_sujets.id DESC LIMIT 5";

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
	//SELECT f_sujets.id, membre.pseudo, f_sujets.sujet, f_categorie.contenu_c, f_sujets.contenu_s, f_sujets.date_hres_creation, f_messages.contenu_m FROM f_sujets 
		// INNER JOIN f_messages, f_categorie, membre WHERE sujet = ? 
		// AND f_sujets.id = ? AND f_sujets.id = f_messages.id_sujet 
		// AND f_categorie.id = f_sujets.id_categorie AND membre.idmembre = f_sujets.id_createur  

	//SELECT f_sujets.id, membre.pseudo, f_sujets.sujet, f_categorie.contenu_c, f_sujets.contenu_s, f_sujets.date_hres_creation FROM f_sujets INNER JOIN f_categorie, membre WHERE sujet = 'La femme n\'est pas toujour comme cela' AND f_sujets.id = 12  AND f_categorie.id = f_sujets.id_categorie AND membre.idmembre = f_sujets.id_createur
	
	function get_sujet_by_id($s, $id){
		// $sql = 'SELECT sujet, contenu_c, contenu_s, date_hres_creation FROM f_sujets INNER JOIN f_messages, f_categorie WHERE sujet = ? AND f_sujets.id = ? AND f_sujets.id = f_messages.id_sujet  AND f_categorie.id = f_sujets.id_categorie  ';

		$sql = "SELECT f_sujets.id, membre.pseudo, f_sujets.sujet, f_categorie.contenu_c, f_sujets.contenu_s, f_sujets.date_hres_creation FROM f_sujets INNER JOIN f_categorie, membre WHERE sujet = ? AND f_sujets.id = ?  AND f_categorie.id = f_sujets.id_categorie AND membre.idmembre = f_sujets.id_createur";
		$req = $this->db->query($sql, array( $s, $id ) );
		
		if ($req->num_rows() === 1 ) {
			return $req->result_object();
		}else {
			// false;
			return $req->result_object();
		}
	}

	// used
	function comment($id_sujet, $cm) {

		$sql = 'SELECT * FROM f_sujets WHERE id = '.$id_sujet;

		$user_id 	= $this->session->userdata('idmembre');

		$req = $this->db->query($sql, array( $user_id));
		if($req->num_rows()){
			foreach ($req->result() as $key ) {
				$sujet_id = $key->id ;

				$query = "INSERT INTO f_messages ( id_sujet, date_hres_edition, contenu_m, id_poster_comment) VALUES ( ?, CURRENT_TIMESTAMP(), ?, ? ) ";
				$req1 = $this->db->query($query, array($sujet_id, $cm, $user_id ));
			}
		}
	}
}