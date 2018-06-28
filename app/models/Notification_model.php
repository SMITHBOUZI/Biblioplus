<?php 

class Notification_model extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	function notification () {
		$sql = 'SELECT * FROM evenement WHERE notify = 1';
		return $this->db->query($sql)->result();
	}

	function count_notify () {
		$sql = 'SELECT count(notify) as nbr_notify FROM evenement WHERE notify = 1';
		// $sql1 = 'SELECT count(notify) as nbr_notify FROM ouvrage WHERE notify = 1';
		// return $this->db->query($sql1)->result();
		return $this->db->query($sql)->result();
	}

	function vue_notify ($notify_id) {
		$sql = 'UPDATE evenement SET notify = 0 WHERE idevenement = ?';
		$this->db->query($sql, array($notify_id));
	}

	function count_membre () {
		$sql = 'SELECT count(idmembre) as nbr_membre FROM membre ';
		// $sql1 = 'SELECT count(notify) as nbr_notify FROM ouvrage WHERE notify = 1';
		// return $this->db->query($sql1)->result();
		return $this->db->query($sql)->result();
	}

	function count_evenement () {
		$sql = 'SELECT count(idevenement) as nbr_event FROM evenement ';
		// $sql1 = 'SELECT count(notify) as nbr_notify FROM ouvrage WHERE notify = 1';
		// return $this->db->query($sql1)->result();
		return $this->db->query($sql)->result();
	}

	function count_post () {
		$sql = 'SELECT count(id) as nbr_sujet FROM f_sujets ';
		// $sql1 = 'SELECT count(notify) as nbr_notify FROM ouvrage WHERE notify = 1';
		// return $this->db->query($sql1)->result();
		return $this->db->query($sql)->result();
	}

	function count_ouvrege() {
		$sql = 'SELECT count(idouvrage) as nbr_ouvrage FROM ouvrage ';
		// $sql1 = 'SELECT count(notify) as nbr_notify FROM ouvrage WHERE notify = 1';
		// return $this->db->query($sql1)->result();
		return $this->db->query($sql)->result();
	}
}