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
}