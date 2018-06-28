
<h1>Pagination </h1>

<?php
	// function page() {
 
 //       $config = array();
 
 //       $config["base_url"] = base_url() . "auteur/page";
 
 //       $config["total_rows"] = $this->Auteur_model->record_count();
 
 //       $config["per_page"] = 1;
 
 //       $config["uri_segment"] = 3;
 
 //       $this->pagination->initialize($config);
 
 //       $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
 
 //       $data["results"] = $this->Auteur_model->fetch_departments($config["per_page"], $page);
 
 //       $data["links"] = $this->pagination->create_links();
 
	// 	// $this->load->view('auteur/index', $data);
 //        // $this->load->view("evenement/Test", $data);
	// 	// $this->load->view('templates/header', $data);
 // 	  	// $this->load->view("auteur/index");
 //    }
?>


<?php

   $config = array();

   $config["base_url"] = base_url() . "auteur/page";

   $config["total_rows"] = $this->Auteur_model->record_count();

   $config["per_page"] = 1;

   $config["uri_segment"] = 3;

   $this->pagination->initialize($config);

   $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

   $data["results"] = $this->Auteur_model->fetch_departments($config["per_page"], $page);

   $data["links"] = $this->pagination->create_links();

   // var_dump($data);

?>
<p><?php echo $data['links']; ?></p>
