<<<<<<< HEAD
<div class="row" style="margin-top:2em;">
	<div class="columns large-12 medium-12 small-12" >
		<h3 style="text-align:center;">Bienvenue sur le forum Biblioplus</h3>
=======
<div class="row" id="forum_view" >
	<div class="columns large-12 medium-12" id="entete">
		<h3 align="center"> Bienvenue sur le forum Biblioplus</h3>
>>>>>>> 8dbcaa63ade5a8b36ea3647ad89d9acd3ba0bfe4
		<?php if (isset($_SESSION['flash'])): ?>
				<?php foreach ($_SESSION['flash'] as $type => $message):?>
					 <div class="alert alert-<?= $type; ?>">
							<?= $message; ?> 						
					 </div>
				<?php endforeach ?>
				<?php unset($_SESSION['flash']) ?>
			<?php endif ?>
	</div>

<<<<<<< HEAD
	<div class="columns large-12 medium-12 small-12">
		<div class="columns large-12 medium-3 small-12">
			<?php if ($this->session->userdata('pseudo') !== NULL) { ?>
				<button id="nouveauSujet" class="fill_button">Nouveau sujet</button> 
=======
	<div class="columns large-12 medium-12" style="position: relative; bottom: 10px; padding:0px;" >
		<div class="columns large-12 medium-3">
			<?php if ($this->session->userdata('pseudo') !== NULL) { ?>
				<button id="nouveauSujet">Nouveau sujet</button> 
>>>>>>> 8dbcaa63ade5a8b36ea3647ad89d9acd3ba0bfe4
			<?php } else {?>
			<button id="ajouterSujet" class="fill_button"><i class="fa fa-plus"> </i>Nouveau sujet
			</button> 
			<?php }?>
		</div>


<<<<<<< HEAD

<div class="row" id="nouveau_sujet_view" >
	<div class="columns large-9 medium-9 large-centered medium-centered">
=======
<div class="row" id="nouveau_sujet_view" >
	<div class="columns large-12 medium-9 large-centered medium-centered">
>>>>>>> 8dbcaa63ade5a8b36ea3647ad89d9acd3ba0bfe4

	
		<!-- <form class="columns large-12 medium-12" > -->
			<!-- REGISTRATION FORM -->
		    
		      <?php //endif ?>

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
<<<<<<< HEAD
				<h5>Poster votre nouveau sujet</h5>
			</div>
			<div class=" columns large-12 medium-12 ">
				
				<div class="columns large-12 medium-12"> 
				<label > Sujet
					<input type="text" name="tsujet" id="tsujet" placeholder="votre sujet" >	
					</label>				
=======
				<h4 style="text-align: center; color: #2e7f4d;">Nouveau sujet</h4>
			</div>
			<div class=" columns large-12 medium-12 ">
				<div class="columns large-3 medium-3"> 
					<label> Sujet</label>		
				</div>
				<div class="columns large-9 medium-9"> 
					<input type="text" name="tsujet" id="tsujet" placeholder="placer votre sujet" class="custom_input">					
>>>>>>> 8dbcaa63ade5a8b36ea3647ad89d9acd3ba0bfe4
				</div>				
			</div>

			<div class=" columns large-12 medium-12 ">
<<<<<<< HEAD
				
				<div class="columns large-9 medium-9">
				
					<?php $req = $this->forum_model->get_sujet_cat(); ?>
				   
                   
				    <select id="categorie" name="categorie">
				    	<option> Categorie </option>
				    	<?php foreach ($req as $rows) :?>

				      <option value="<?php echo $rows->contenu_c; ?>" ><?php echo $rows->contenu_c; ?></option>
				       <?php endforeach?>
				    </select>
				   
=======
				<div class="columns large-3 medium-3"> 
					<label> Categorie</label>		
				</div>
				
				<div class="columns large-9 medium-9">
					<?php $req = $this->forum_model->get_sujet_cat(); ?>
				    <select id="categorie" name="categorie">
				    	<option> Categorie </option>
				    	<?php foreach ($req as $rows) :?>
				      <option value="<?php echo $rows->contenu_c; ?>" ><?php echo $rows->contenu_c; ?></option>
				       <?php endforeach?>
				    </select>
>>>>>>> 8dbcaa63ade5a8b36ea3647ad89d9acd3ba0bfe4
				</div>			
			</div>

			<div class=" columns large-12 medium-12 ">
				<div class="columns large-3 medium-3"> 
					<label> Contenu</label>		
				</div>
				<div class="columns large-9 medium-9">					
<<<<<<< HEAD
			<textarea  rows="6" cols="50" placeholder="" name="tcontenue" class="tcontenue"></textarea>					
				</div>				
			</div>
			<div class="columns large-12 medium-12">
				<input type="submit" name="poster" value="Poster" class="fill_button" />
=======
			<textarea  rows="6" cols="40" placeholder="" name="tcontenue" class="tcontenue"></textarea>					
				</div>				
			</div>
			<div class="columns large-12 medium-12">
				<input type="submit" name="poster" value="poster" id="custom_input_post" />
>>>>>>> 8dbcaa63ade5a8b36ea3647ad89d9acd3ba0bfe4
			</div>
			<?php echo form_close();  ?>
		<!-- </form> -->
	</div>	
<<<<<<< HEAD
	<hr>
=======
>>>>>>> 8dbcaa63ade5a8b36ea3647ad89d9acd3ba0bfe4



		<div class="columns large-6 medium-6">
			
		</div>
	</div>
	<div class=" columns large-12 medium-12 small-12" >
		<table>
			<div class="columns large-12 medium-12 small-12" ;>
			<thead>
				<div class="columns large-12 medium-12 small-12">
					<tr>
						<div class=" columns large-4 medium-4 small-6">
							<th>Sujet</th>
						</div>
						<div class=" columns large-2 medium-2 small-3">
							<th>Categorie</th>
						</div>
						<div class=" columns large-3 medium-3 small-3">
							<th>Utilisateurs</th>
						</div>
						<div class=" columns large-1 medium-1 small-3">
							<th>r&eacuteponses</th>
						</div>
						<div class=" columns large-2 medium-2 small-3">
							<th>Date de creation</th>
						</div>						
					</tr>
				</div>				
			</thead>
			</div>

			<div class="columns large-12 medium-12 small-12">
			<tbody>
				<div class="columns large-12 medium-12 small-12">
						<?php foreach ($forums as $rows): ?>
<<<<<<< HEAD
							  
=======
>>>>>>> 8dbcaa63ade5a8b36ea3647ad89d9acd3ba0bfe4
							<tr>
								<div class=" columns large-6 medium-6 small-6">
									<td>
										<p>
											<a href="http://localhost/biblioplus/forum/view?s=<?php echo $rows->sujet ; ?>&id=<?php echo $rows->id; ?>"><?php echo $rows->sujet; ?> </a>
										</p>
									</td>
								</div>
								<div class=" columns large-3 medium-3 small-3">
									<td> 
										<h6 style="font-weight: bold;"><?php echo $rows->topics_cat->contenu_c; ?></h6>
									</td>
								</div>
								<div class=" columns large-3 medium-3 small-3">
									<td>
										<p><?php echo $rows->topics_mem->pseudo; ?></p>
									</td>
								</div> 
								<div class=" columns large-3 medium-3 small-3">
									<td>
										<p><?php  echo $rows->count_posts; ?></p>
									</td>
								</div>
								<div class=" columns large-3 medium-3 small-3">
									<td>
										<p><?php echo $rows->date_hres_creation; ?></p>
									</td>
								</div>						
							</tr>
						<?php endforeach ?>
				</div>				
			</tbody>
			</div>
        </table>
	</div>
 



</div>
</div>