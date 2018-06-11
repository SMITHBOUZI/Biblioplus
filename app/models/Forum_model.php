<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_model extends CI_Model {

	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url'));
	} 

	function nouveau_sujet($user_id, $ts, $tc){
		$cat = htmlspecialchars($this->input->post('categorie'));

		$sql = "SELECT * FROM f_categorie";
		$req = $this->db->query($sql);
		if ($req->num_rows()) {
			foreach ($req->result() as $key) {
				if ($key->contenu_c !== $cat ) {
					// return false;
				} else {
					$requte = "INSERT INTO f_sujets ( `idmembre`, `id_categorie`, `sujet`, `contenu_s`, `date_hres_creation`) VALUES ( ?, ?, ?, ?, CURRENT_TIMESTAMP() )";
					$this->db->query($requte, array($user_id, $key->id, $ts, $tc ));

					$sql = "SELECT * FROM f_sujets WHERE id = ? AND idmembre = ?";

					$sujet_id 	= $this->db->insert_id();
					$user_id 	= $this->session->userdata('idmembre');

					$req = $this->db->query($sql, array($sujet_id, $user_id));
				}
			}
		}
	}

	// used
	function comment($id_sujet, $cm) {

		$sql = "SELECT * FROM f_sujets WHERE id = ".$id_sujet;

		$user_id 	= $this->session->userdata('idmembre');
		$pseudo 	= $this->session->userdata('pseudo');

		$req = $this->db->query($sql, array($user_id));
		if($req->num_rows()){
			foreach ($req->result() as $key ) {
				$sujet_id = $key->id ;

				$query = "INSERT INTO f_messages ( id_sujet, date_hres_edition, contenu_m, idmembre, pseudo_poster) VALUES ( ?, CURRENT_TIMESTAMP(), ?, ?, ?) ";
				$req1 = $this->db->query($query, array($sujet_id, $cm, $user_id, $pseudo ));
			}
		}
	}

	function get_sujet_cat(){
		$sql = "SELECT * FROM f_categorie";
		$req 	= $this->db->query($sql );

		if ($req->num_rows()) {
			return $req->result();
		} else {
			// false;
			return $req->result() ;
		}
	}

	
	public function get_forums() {
		$this->db->order_by('id', 'DESC');
		$this->db->limit(14);
		return $this->db->get('f_sujets')->result();		
	}

	public function get_topic_mem($membre_id) {
		
		$this->db->select("membre.pseudo, membre.photo");
		$this->db->from('f_sujets'); 
		$this->db->join('membre', 'membre.idmembre = f_sujets.idmembre');
		$this->db->where('membre.idmembre', $membre_id);
		return $this->db->get()->row();		
	}

	public function get_forum_topics($f_msg_id) {
		
		$this->db->from("f_messages");
		$this->db->where('id', $f_msg_id);
		return $this->db->get()->result();		
	}

	public function count_forum_posts($f_suj_id) {
		
		$this->db->select("f_messages.id_sujet,f_messages.contenu_m");
		$this->db->from('f_messages');
		$this->db->join('f_sujets', 'f_messages.id_sujet = f_sujets.id');
		$this->db->where('f_sujets.id', $f_suj_id);
		$this->db->group_by('f_messages.id');
		return count($this->db->get()->result());
		
	}

	public function fetch_forum_posts($f_suj_id) { 
		$this->db->from('f_sujets');
		$this->db->join('f_categorie', 'f_sujets.id_categorie = f_categorie.id');
		$this->db->where('f_sujets.id', $f_suj_id);
		return $this->db->get()->result();
	}

	public function get_topic_cat($cat_id) {
		$this->db->select("contenu_c");
		$this->db->from('f_categorie');
		$this->db->where('id', $cat_id);
		return $this->db->get()->row();
	}

	public function get_topic_post($f_suj_id) {
		$this->db->select("contenu_m, pseudo_poster,date_hres_edition, id_sujet");
		$this->db->from('f_messages');
		$this->db->where('id_sujet', $f_suj_id);
		return $this->db->get()->result();
	}

	public function sujet_valid ($sujet_id, $sujet){
		$sql = "SELECT * FROM f_sujets WHERE id = ? AND sujet = ?" ;
		$r = $this->db->query($sql, array($sujet_id, $sujet));
		if ($r->num_rows() === 1) {
			return $r->result();
		} else {
			echo "Sujet not exist ..";
		}

	}
}