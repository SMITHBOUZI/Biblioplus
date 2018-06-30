<?php 

class Recherche_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	function search($search){
		
		// if ($_GET['search']) {
			$sql = "
				SELECT idmembre, pseudo, 'MEMBRE' AS type FROM membre WHERE Upper(pseudo) = ? || Upper(pseudo) like '".$search."%'
				UNION 
				(
				SELECT idevenement, titre, 'EVENEMENT' AS type FROM evenement WHERE Upper(titre) = ? || Upper(titre) like '".$search."%' 
				)
				UNION SELECT idouvrage, titre, 'OUVRAGE' AS type FROM ouvrage WHERE Upper(titre) = ? || Upper(titre) like '".$search."%' 
			";

			$query = $this->db->query($sql, array($search, $search, $search)); // var_dump($query);

			if ($query->num_rows() > 0 ) {
				return $query->result();
			} else {
				// echo "Data not found ..";
				// return false;
				return $query->result();
			}
		//}
	}

	// function 
}


// SELECT idmembre, pseudo, 'MEMBRE' AS type FROM membre WHERE Upper(pseudo) = 'F' || Upper(pseudo) like 'F%'
// UNION 
// (
// SELECT idevenement, titre, 'EVENEMENT' AS type FROM evenement WHERE Upper(titre) = 'F' || Upper(titre) like 'F%' 
// )
// UNION SELECT idouvrage, titre, 'OUVRAGE' AS type FROM ouvrage WHERE Upper(titre) = 'F' || Upper(titre) like 'F%' 
// 			

