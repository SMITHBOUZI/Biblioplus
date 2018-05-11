<link href="<?php // echo base_url('assets/css/app.css') ?>" rel='stylesheet' type='text/css'>
<link href="<?php // echo base_url('assets/css/bootstrap.min.css') ?>" rel='stylesheet' type='text/css'>

 <div class="container">	
		<div class="panel panel-info">
			<!--C Moi -->
			 <?php if (validation_errors()): ?> 
				 <div class="alert alert-danger">
						<?php echo validation_errors(); ?> 						
				 </div>
			  <?php endif ?>
			<!-- fin MOi -->
		
			<?php if (isset($_SESSION['flash'])): ?>
				<?php foreach ($_SESSION['flash'] as $type => $message):?>
					 <div class="alert alert-<?= $type; ?>">
							<?= $message; ?> 						
					 </div>
				<?php endforeach ?>
				<?php unset($_SESSION['flash']) ?>
			<?php endif ?>

			<div class="panel-heading"><h1>Reinitialisation du mot de passe</h1> <span><?php // echo $err; ?></span></div>
			<div class="panel-body">
				<!-- Main Form -->
				<div class="login-form-1">
					<!-- <form id="login-form" class="text-left"> -->
					<?php  echo form_open('account/update_pass', "class='myclass'" ); ?>			
						<!-- <div class="login-form-main-message"></div> -->

						<div class="main-login-form">
							<div class="login-group">
								<div class="form-group">
									<?php echo form_label('Mot de passe', 'mot_de_passe'); ?>
									<?php echo form_password('mot_de_passe','','class="form-control" id="mot_de_passe" placeholder="Mot de passe"'); ?>
								</div>
								<div class="form-group">
									<?php echo form_label('Confirmation', 'mot_de_passe_c') ?>
									<?php echo form_password('mot_de_passe_c','','class="form-control" id="mot_de_passe_c" placeholder="Mot de passe de confirmation" ') ?>
								</div> 
							</div>

							<button type="submit" class="btn btn-primary" name="update_pass" value="update_pass">
								Valide
							</button>

						</div>						
					<?php echo form_close(); ?>
				</div>
			   <!-- end:Main Form -->

			</div>
			 
		</div> 
		<div class="etc-login-form">
			<div class="col-sm-10">
				<p>  <a href="<?php echo base_url('login'); ?>">login here</a></p>
			</div>
		</div>
</div>