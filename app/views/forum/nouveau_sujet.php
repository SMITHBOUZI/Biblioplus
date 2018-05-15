<?php 
	if ($this->session->userdata('pseudo') === NULL) {
		# code...
		redirect(base_url('login/Sign_in'));
	}
	// 'AAAA-MM-JJ HH:MM:SS'		'%Y-%m-%d %h:%i:%s'
	$datestring = '%Y-%m-%d %h:%i:%s';
	$time = NOW();
	echo mdate($datestring, $time); 
?>

<div class="row" id="nouveau_sujet_view">
	<div class="columns large-12 medium-12">
		<div class="columns large-12 medium-12">
			<h4>Nouveau sujet</h4>
		</div>
	</div>	
</div>


