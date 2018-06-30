<?php
class Evenement_model extends CI_Model { 
 	
 	function __construct() {
		$this->load->database();		
 		parent::__construct();

 		$this->load->helper('form');
 		$this->load->library('form_validation');
 	}

 	function add($nom,$user_id,$lieuEvent,$dateEvent,$descEvent, $datedebutEvent,$datefinEvent,$Activites,$prix,$pointDevente,$foto) {
    	$data = array(
    		'titre'				=> $nom,
    		'idmembre'			=> $user_id,
    		'lieuEvenement'		=> $lieuEvent,
    		'description'		=> $descEvent,

    		'date_debut'		=> $datedebutEvent,
    		'date_fin'			=> $datefinEvent,
    		'activite'			=> '1',
    		'prix'				=> $prix,
    		'point_de_vente'	=> $pointDevente,
    		'photo'				=> $foto,
			'date_creation'		=>  date('Y-m-j H:i:s'),
			'notify'			=> '1'			
    	);
    	$this->db->insert('evenement', $data);
	}

	function lister() {
		// $r = setlocale(LC_TIME, "fr_FR", "French");
		$sql = 'SELECT  DATE_FORMAT(evenement.date_debut, "%d %M %Y") as event_mois, DATE_FORMAT(evenement.date_debut, "%a %d %M %Y %r") as event_deb, DATE_FORMAT(evenement.date_fin, "%a %d %M %Y %r") as event_fin, evenement.idevenement, evenement.photo, evenement.titre, evenement.lieuEvenement, evenement.description, evenement.date_creation, evenement.activite, evenement.date_debut, evenement.date_fin, evenement.prix, evenement.point_de_vente, membre.pseudo, membre.email, evenement.idmembre FROM evenement INNER JOIN membre on evenement.idmembre = membre.idmembre ORDER BY idevenement';
		$req = $this->db->query($sql);

		if ($req->num_rows() > 0) {
			return $req->result_object();
		} else {
			return $req->result_object();
			// return 'pas de nouvelle evenement';
		}		
	}

	function lister_event_index() {
		$sql = 'SELECT  DATE_FORMAT(evenement.date_debut, "%d %M %Y") as event_mois, DATE_FORMAT(evenement.date_debut, "%a %d %M %Y %r") as event_deb, DATE_FORMAT(evenement.date_fin, "%a %d %M %Y %r") as event_fin, evenement.idevenement, evenement.photo, evenement.titre, evenement.lieuEvenement, evenement.description, evenement.date_creation, evenement.activite, evenement.date_debut, evenement.date_fin, evenement.prix, evenement.point_de_vente, membre.pseudo, membre.email, evenement.idmembre FROM evenement INNER JOIN membre on evenement.idmembre = membre.idmembre ORDER BY idevenement LIMIT 4';
		$req = $this->db->query($sql);

		if ($req->num_rows() > 0) {
			return $req->result_object();
		} else {
			return $req->result_object();
			// return 'pas de nouvelle evenement';
		}		
	}

	public function record_count() {
		return $this->db->count_all("evenement");
	}

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

	function delete ($idevenement) {
		$sql = 'DELETE FROM evenement WHERE idevenement = ?';
		$this->db->query($sql, array($idevenement));
	}

	function modifier_evenement(){
  		// $user_id = $this->session->userdata('idmembre');
  		$idevenement = $this->input->post('idEvent'); 
  		$titreEvent = $this->input->post('titreEvent');

  		$req = "UPDATE evenement SET titre = ? WHERE idevenement = ?";
  		$this->db->query($req, array($titreEvent, $idevenement));    
    }

    function evenement_membre() {
      
        if (isset($_GET['id'])) {
            $id_membre = $_GET['id'];
            $sql = "SELECT * FROM evenement WHERE idmembre = ?";
            $req = $this->db->query($sql, array($id_membre));

            if ( $req->num_rows() > 0 ) {
                return $req->result();
            } else {
                return false;
            }
        }
    }
}