<?php 
if ($this->session->userdata('pseudo') === NULL) {
	$_SESSION['flash']['danger'] = 'Connecter pour creer un enevenement ';
	redirect('event/index');
}
?>

<?php if (isset($_SESSION['flash'])): ?>
	<?php foreach ($_SESSION['flash'] as $type => $message):?>
	   <div class="alert alert-<?= $type; ?>">
	      <?= $message; ?>            
	   </div>
	<?php endforeach ?>
	<?php unset($_SESSION['flash']) ?>
<?php endif ?>

<div class="row">
	<div class="columns large-6 medium-6 large-centered medium-centered" id="nouveau_evenement">
	<div class=" columns large-12 medium-12">
		<!-- <form > -->
			<?php echo form_open_multipart('event/ajouter','');?> 
			<div class="columns large-6 medium-6">
				<img src="http://via.placeholder.com/280x180" class="circle_rectangle">	
			</div>
			<div class="columns large-6 medium-6">
				<input type="text" name="nomEvent" placeholder="Entrez le nom " class="custom_input_evenement">
				<input type="text" name="lieuEvent" placeholder="Lieux/Adresse de " class="custom_input_evenement">
				<input type="date" name="dateEvent" class="custom_input_evenement">
			</div>
			<div class="columns large-12 medium-12">
				<label>Description
				<textarea cols="20" name="descEvent" rows="10"></textarea>
				</label>
			</div>
			<div class="columns large-6 medium-6" class="custum_input">
				<input type="submit" name="addEvent" value="valider"  align="right" style="position: relative; top: 5px;" />	
			</div>
			<?php echo form_close();  ?>
		</form>
	</div>
	</div>
</div>