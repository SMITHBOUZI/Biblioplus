<?php
 /**
 * 
 */
 class Evenement_model extends CI_Model
 { 
 	
 	function __construct()
 	{
		$this->load->database();		
 		parent::__construct();

 		$this->load->helper('form');
 		$this->load->library('form_validation');
 	}

 	function add($nom,$user_id,$lieuEvent,$dateEvent,$descEvent,  $datedebutEvent,$datefinEvent,$Activites,$prix,$pointDevente,$r ) {
		
    	$data = array(
    		'titre'				=> $nom,
    		'idmembre'			=> $user_id,
    		'lieuEvenement'		=> $lieuEvent,
    		'description'		=> $descEvent,

    		'date_debut'		=> $datedebutEvent,
    		'date_fin'			=> $datefinEvent,
    		'activite'			=> $Activites,
    		'prix'				=> $prix,
    		'point_de_vente'	=> $pointDevente,
    		'photo'				=> $r,
			'date_creation'		=>  date('Y-m-j H:i:s')

    	);
    	$this->db->insert('evenement', $data);
	}

	function lister() {
		// SELECT evenement.photo, evenement.titre, evenement.lieuEvenement, evenement.description, evenement.date_creation, evenement.date_debut, evenement.date_fin, evenement.prix, evenement.point_de_vente, membre.pseudo, membre.email FROM evenement INNER JOIN membre on evenement.idmembre = membre.idmembre ORDER BY idevenement
		// $sql = 'SELECT * FROM evenement INNER JOIN membre on evenement.idmembre = membre.idmembre ORDER BY idevenement';
		$sql = 'SELECT evenement.idevenement, evenement.photo, evenement.titre, evenement.lieuEvenement, evenement.description, evenement.date_creation, evenement.date_debut, evenement.date_fin, evenement.prix, evenement.point_de_vente, membre.pseudo, membre.email FROM evenement INNER JOIN membre on evenement.idmembre = membre.idmembre ORDER BY idevenement';
		$req = $this->db->query($sql);

		if ($req->num_rows() > 0) {
			return $req->result_object();
		} else {
			return $req->result_object();
			// return 'pas de nouvelle evenement';
		}		
	}

	// Count all record of table "contact_info" in database.
	public function record_count() {
		return $this->db->count_all("evenement");
	}

	// Fetch data according to per_page limit.
	public function fetch_data($limit, $id) {
		$this->db->limit($limit);
		$this->db->where('idevenement', $id);
		$query = $this->db->get("evenement");
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}
}