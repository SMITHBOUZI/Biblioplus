<?php 

/**
* 
*/
class Exception extends CI_Exceptions
{
	
	function __construct()
	{
		parent::__construct();
	}

	function show_404($page = '') {
		header("HTTP/1.1 404 Page indisponible ..");
		$heading = 'Page indisponible ..';
		$message = 'La page que vous avez demande n\'est pas disponible ';
		$this->$CI =& get_instance();
		$this->$CI->load->view('errors/html/error_exception');
	}
}