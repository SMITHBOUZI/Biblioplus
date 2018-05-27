<?php
 /**
 * 
 */
 class Evenement_model extends CI_Model
 {
 	
 	function __construct()
 	{
 		parent::__construct();
 	}

 	function add($nom,$user_id,$lieuEvent,$dateEvent,$descEvent) {

    	$data = array(
    		// 'photo'				=> $photo,
    		'nom'				=> $nom,
    		'idmembre'			=> $user_id,
    		'lieuEvenement'		=> $lieuEvent,
    		'dateEvenement'		=> $dateEvent,
    		'description'		=> $descEvent
    	);
    	$this->db->insert('evenement', $data);
	}

	function lister() {
		$sql = 'SELECT * FROM evenement INNER JOIN membre on evenement.idmembre = membre.idmembre ORDER BY idevenement LIMIT 5';
		$req = $this->db->query($sql);

		if ($req->num_rows() > 0) {
			return $req->result_object();
		} else {
			return 'pas de nouvelle evenement';
		}		
	}

	function update()	{
		
	}

	function del()	{
		
	}
 }