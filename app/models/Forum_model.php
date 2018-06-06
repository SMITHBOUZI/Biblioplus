<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Forum_model extends CI_Model {

	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url'));
	} 

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


	function get_sujet_by_id($s, $id){
		//SELECT f_sujets.id, membre.pseudo, f_sujets.sujet, f_categorie.contenu_c, f_sujets.contenu_s, f_sujets.date_hres_creation FROM f_sujets INNER JOIN f_categorie, membre WHERE sujet = ? AND f_sujets.id = ?  AND f_categorie.id = f_sujets.id_categorie AND membre.idmembre = f_sujets.id_createur
		//SELECT f_messages.pseudo as poster_comment, f_messages.date_hres_edition, f_messages.contenu_m, f_sujets.id, membre.photo, membre.pseudo, f_sujets.sujet, f_categorie.contenu_c, f_sujets.contenu_s, f_sujets.date_hres_creation FROM f_sujets, f_messages INNER JOIN f_categorie, membre WHERE sujet = 'Le sujet du siecle' AND f_sujets.id = 14  AND f_categorie.id = f_sujets.id_categorie AND membre.idmembre = f_sujets.id_createur AND f_messages.id_sujet = f_sujets.id
		$sql = "SELECT f_messages.pseudo_poster as poster_comment, f_messages.date_hres_edition, f_messages.contenu_m, f_sujets.id, membre.photo, membre.pseudo as poster, f_sujets.sujet, f_categorie.contenu_c, f_sujets.contenu_s, f_sujets.date_hres_creation FROM f_sujets, f_messages INNER JOIN f_categorie, membre WHERE sujet = ? AND f_sujets.id = ?  AND f_categorie.id = f_sujets.id_categorie AND membre.idmembre = f_sujets.id_createur AND f_messages.id_sujet = f_sujets.id";
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
		$pseudo 	= $this->session->userdata('pseudo');

		$req = $this->db->query($sql, array($user_id));
		if($req->num_rows()){
			foreach ($req->result() as $key ) {
				$sujet_id = $key->id ;

				$query = "INSERT INTO f_messages ( id_sujet, date_hres_edition, contenu_m, id_poster_comment, pseudo) VALUES ( ?, CURRENT_TIMESTAMP(), ?, ?, ?) ";
				$req1 = $this->db->query($query, array($sujet_id, $cm, $user_id, $pseudo ));
			}
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

	/**
	 * get_forums function.
	 * 
	 * @access public
	 * @return array of objects
	 */
	public function get_forums() {
		$this->db->order_by('id', 'DESC');
		$this->db->limit(14);
		return $this->db->get('f_sujets')->result();		
	}

	/**
	 * get_forum function.
	 * 
	 * @access public
	 * @param int $forum_id
	 * @return object
	 */
	public function get_topic_mem($membre_id) {
		
		$this->db->select(' membre.pseudo');
		$this->db->from('f_sujets'); 
		$this->db->join('membre', 'membre.idmembre = f_sujets.id_createur');
		$this->db->where('membre.idmembre', $membre_id);
		return $this->db->get()->row();
		
	}
	
	/**
	 * get_topic function.
	 * 
	 * @access public
	 * @param int $topic_id
	 * @return object
	 */
	public function get_topic_cat($cat_id) {
		$this->db->select('contenu_c');
		$this->db->from('f_categorie');
		$this->db->where('id', $cat_id);
		return $this->db->get()->row();
	}
	
	/**
	 * get_forum_topics function.
	 * 
	 * @access public
	 * @param int $forum_id
	 * @return array of objects
	 */
	public function get_forum_topics($f_msg_id) {
		
		$this->db->from('f_messages');
		$this->db->where('id', $f_msg_id);
		return $this->db->get()->result();
		
	}

	/**
	 * count_forum_posts function.
	 * 
	 * @access public
	 * @param int $forum_id
	 * @return int
	 */
	public function count_forum_posts($f_suj_id) {
		
		$this->db->select('f_messages.id_sujet,f_messages.contenu_m');
		$this->db->from('f_messages');
		$this->db->join('f_sujets', 'f_messages.id_sujet = f_sujets.id');
		$this->db->where('f_sujets.id', $f_suj_id);
		$this->db->group_by('f_messages.id');
		return count($this->db->get()->result());
		
	}
	
	/**
	 * get_forum_latest_topic function.
	 * 
	 * @access public
	 * @param int $forum_id
	 * @return object
	 */
	public function get_forum_latest_topic($f_suj_id) {
		
		$this->db->from('f_sujets');
		$this->db->where('id', $f_suj_id);
		$this->db->order_by('date_hres_creation', 'DESC');
		$this->db->limit(1);
		return $this->db->get()->row();		
	}

		/**
	 * get_forum_id_from_forum_slug function.
	 * 
	 * @access public
	 * @param string $slug
	 * @return int
	 */
	public function get_forum_id_from_forum_f_msg($id_sujet) {
		
		// $this->db->select('id');
		$this->db->from('f_messages');
		$this->db->where('id_sujet', $id_sujet);
		return $this->db->get()->row('id');
		
	}
	
	/**
	 * get_topic_id_from_topic_slug function.
	 * 
	 * @access public
	 * @param string $topic_slug
	 * @return int
	 */
	public function get_topic_id_from_topic_f_sujet($sujet) {
		
		$this->db->select('id');
		$this->db->from('f_sujets');
		$this->db->where('sujet', $sujet);
		return $this->db->get()->row('id');
		
	}

	/**
	 * count_forum_posts function.
	 * 
	 * @access public
	 * @param int $forum_id
	 * @return int
	 */
	public function fetch_forum_posts($f_suj_id) {
		
		$this->db->select('f_messages.id_sujet,f_messages.contenu_m');
		$this->db->from('f_messages');
		$this->db->join('f_sujets', 'f_messages.id_sujet = f_sujets.id');
		$this->db->where('f_sujets.id', $f_suj_id);
		$this->db->group_by('f_messages.id');
		return $this->db->get()->result();
		
	}

}