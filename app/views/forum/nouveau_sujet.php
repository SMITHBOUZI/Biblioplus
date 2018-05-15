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

<div class="row" id="nouveau_sujet_view" >
	<div class="columns large-9 medium-9 large-centered medium-centered">
		<form class="columns large-12 medium-12">
		<div class="columns large-12 medium-12">			
			<h4>Nouveau sujet</h4>
		</div>
		<div class=" columns large-12 medium-12 ">
			<div class="columns large-3 medium-3"> 
				<label> Sujet</label>		
			</div>
			<div class="columns large-9 medium-9"> 
				<input type="text" name="sujet" placeholder="placer votre sujet" class="custom_input">					
			</div>				
		</div>

		<div class=" columns large-12 medium-12 ">
			<div class="columns large-3 medium-3"> 
				<label> Categorie</label>		
			</div>
			<div class="columns large-9 medium-9"> 
				<select>
					<option>Religion</option>
					<option>Roman</option>
					<option>Poesie</option>
					<option>Science</option>
					<option></option>
				</select>					
			</div>				
		</div>

		<div class=" columns large-12 medium-12 ">
			<div class="columns large-3 medium-3"> 
				<label> Sujet</label>		
			</div>
			<div class="columns large-9 medium-9"> 
				
				<textarea placeholder=""></textarea>					
			</div>				
		</div>
		<div class="columns large-12 medium-12">
			<input type="submit" name="valider" value="valider" class="custom_input">
		</div>
		</form>
	</div>	
</div>


