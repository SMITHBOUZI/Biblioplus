<?php 

class Collection_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function lister () {
		$sql = "SELECT * FROM ouvrage GROUP BY idouvrage DESC LIMIT 5";
		$req = $this->db->query($sql);
		
		if ($req->num_rows() > 0) {
			return $req->result_object();
		} else {
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

	function lister_categories () {
		$sql = " SELECT * FROM l_categories ";
		$req = $this->db->query();
		
		if ($req->num_rows() > 0) {
			return $req->result_object();
		} else {
			return false;
		}
	}

	function lister_by_categorie () {
		$sql = "SELECT * FROM ouvrage INNER JOIN l_categories ON ouvrage.id_l_cat = l_categories.id";
		$req = $this->db->query();
		
		if ($req->num_rows() > 0) {
			return $req->result_object();
		} else {
			return false;
		}
	}

	function lister_by_id () {
		$sql = "SELECT ouvrage.langue, ouvrage.titre, ouvrage.description, ouvrage.edition, ouvrage.images, ouvrage.isbn, ouvrage.pages, ouvrage.point_de_vente, membre.pseudo, membre.photo, membre.email, l_categories.cat_nom FROM ouvrage INNER JOIN l_categories, membre WHERE ouvrage.id_l_cat = l_categories.id AND membre.idmembre = ouvrage.id_membre";
		$req = $this->db->query();
		
		if ($req->num_rows() > 0) {
			return $req->result_object();
		} else {
			return false;
		}
	}
}