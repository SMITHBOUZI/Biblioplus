<?php 
	if ($this->session->userdata('pseudo') === NULL) {
		$_SESSION['flash']['info'] = 'Connecter vous !';
		redirect(base_url('forum/index'));
	}
?>

<div class="row" id="nouveau_sujet_view" >
	<div class="columns large-9 medium-9 large-centered medium-centered">
		<!-- <form class="columns large-12 medium-12" > -->
			<!-- REGISTRATION FORM -->
		     <?php if (validation_errors()): ?> 
		       <div class="alert alert-danger">
		          <?php echo validation_errors(); ?> 
		       </div>
		      <?php endif ?>

		      <?php if (isset($_SESSION['flash'])): ?>
		        <?php foreach ($_SESSION['flash'] as $type => $message):?>
		           <div class="alert alert-<?= $type; ?>">
		              <?= $message; ?>            
		           </div>
		        <?php endforeach ?>
		        <?php unset($_SESSION['flash']) ?>
		      <?php endif ?>
		<?php echo form_open_multipart('forum/nouveau_sujet','class="columns medium-12 large-12"');?> 
			<div class="columns large-12 medium-12">			
				<h4>Nouveau sujet</h4>
			</div>
			<div class=" columns large-12 medium-12 ">
				<div class="columns large-3 medium-3"> 
					<label> Sujet</label>		
				</div>
				<div class="columns large-9 medium-9"> 
					<input type="text" name="tsujet" id="tsujet" placeholder="placer votre sujet" class="custom_input">					
				</div>				
			</div>

			<div class=" columns large-12 medium-12 ">
				<div class="columns large-3 medium-3"> 
					<label> Categorie</label>		
				</div>
				
				<div class="columns large-9 medium-9">
					<?php $req = $this->forum->get_sujet_cat(); ?>
				    <select id="categorie" name="categorie">
				    	<option> Categorie </option>
				    	<?php foreach ($req as $rows) :?>
				      <option value="<?php echo $rows->contenu_c; ?>" ><?php echo $rows->contenu_c; ?></option>
				       <?php endforeach?>
				    </select>
				</div>			
			</div>

			<div class=" columns large-12 medium-12 ">
				<div class="columns large-3 medium-3"> 
					<label> Contenu</label>		
				</div>
				<div class="columns large-9 medium-9">					
					<textarea placeholder="" name="tcontenue" class="tcontenue"></textarea>					
				</div>				
			</div>
			<div class="columns large-12 medium-12">
				<input type="submit" name="poster" value="poster" class="custom_input" />
			</div>
			<?php echo form_close();  ?>
		<!-- </form> -->
	</div>	
</div>


