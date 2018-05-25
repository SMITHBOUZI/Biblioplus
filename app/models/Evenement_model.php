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

 	function add($nom,$user_id,$lieuEvent,$dateEvent)	{
 		
    	$data = array(
    		// 'photo'				=> $photo,
    		'nom'				=> $nom,
    		'idmembre'			=> $user_id,
    		'lieuEvenement'		=> $lieuEvenement,
    		'dateEvenement'		=> $dateEvenement
    	);
    	$this->db->insert('evenement', $data);
	}

	function lister() {
		$sql = 'SELECT * FROM evenement';
		$req = $this->db->query($sql);

		if ($req->num_rows() === 1) {
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