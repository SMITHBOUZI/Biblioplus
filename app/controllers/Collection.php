<?php

/**
* 
*/
class Collection extends CI_Controller
{
	
	function __construct()
	{
 		parent::__construct();
 		$this->load->helper(array('url'));
 		$this->load->library(array('session'));
 		$this->load->model('Collection_model');
 	}

 	public function index() {
		$req = $this->Collection_model->lister();

		if ($req) {
			# afficher les livres ..
			foreach ($req as $key ) {
				$data = array (
					'titre'		=> $key->titre
				);
			}

			// $this->load->view('templates/header');
			// $this->load->view('collection/lister', $data);
		}
		$this->load->view('templates/header');
		$this->load->view('collection/lister');
	}

	function ouvrage()	{
		$this->load->view('templates/header');
		$this->load->view('templates/ouvrage');
		 $this->load->view('templates/footer');
	}

	function auteurs()	{
		$this->load->view('templates/header');
		$this->load->view('auteurs');
		
	}

	public function form_uploaded_doc() {
		$this->form_validation->set_rules('titre', 'titre', 'trim|required|htmlspecialchars');
		$this->form_validation->set_rules('categorie', 'categorie', 'trim|required|htmlspecialchars');
		$this->form_validation->set_rules('pages', 'pages', 'trim|required|htmlspecialchars');
		// $this->form_validation->set_rules('userfile', 'photo', 'trim|required|htmlspecialchars');
		$this->form_validation->set_rules('isbn', 'isbn', 'trim|required|htmlspecialchars');

		if ($this->form_validation->run() === FALSE) {
			$this->load->view('template/header');
			$this->load->view('collection/form_uploaded_doc');
		}else{
			if($this->input->post('save')) {
				$config['upload_path']          = 'assets/livres/';
				$config['allowed_types']        = 'doc|pdf|docx';
				$config['max_size']             = 0;


				$this->upload->initialize($config);
				
				if ( ! $this->upload->do_upload('userfile') ) {
					$_SESSION['flash']['warning'] = 'Ce format n\'est pas prisse en charger ' ;
					$_SESSION['flash']['info'] = 'Essayer avec un format doc | pdf ' ;
					$error = array('error' => $this->upload->display_errors());
					$this->load->view('template/header');
					$this->load->view('collection/form_uploaded_doc');					
				} else {
					$data =  $this->upload->data();			
				} if (!empty($data)) {
				    $this->account->form_uploaded_doc($data);
				    $_SESSION['flash']['success'] = 'Vous venez d\'ajouter un livre felicitation ' ;
				    $this->load->view('template/header');
					$this->load->view('collection/form_uploaded_doc');
				}
			}
		}		     
    }

    function collection(){
		$this->load->view('templates/header');
		$this->load->view('collection/lister');
		$this->load->view('templates/footer');

	}

    

}