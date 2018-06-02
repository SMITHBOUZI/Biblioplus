<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class collection extends CI_Model {


	function lister_ouvrage(){

      $this->db->select('*');
		$this->db->from('ouvrage');
		$query = $this->db->get();

		if ($query->num_rows() == 1) {
			return $query->result();
		}else{
			return false;
		}


	}

	function inserer_ouvrage(){




	}
}