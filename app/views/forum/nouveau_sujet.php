<?php 
	if ($this->session->userdata('pseudo') === NULL) {
		# code...
		redirect(base_url('login/Sign_in'));
	}
	// 'AAAA-MM-JJ HH:MM:SS'		'%Y-%m-%d %h:%i:%s'
	$datestring = '%Y-%m-%d %h:%i:%s';
	$time = NOW();
	echo mdate($datestring, $time); 

	// var_dump($time);


?>


<html>
<head>
<title>Librairieplus</title>
<link href="<?php echo base_url('assets/css/app.css') ?>" rel='stylesheet' type='text/css'>
<link href="<?php echo base_url('assets/css/bootstrap.min.css') ?>" rel='stylesheet' type='text/css'>
<meta name="viewport" content="width=device-width, initial-scale=1">


</head>
<body> 
<div class="container"> 
		
		<!--C Moi -->
		<?php if (validation_errors()): ?> 
			 <div class="alert alert-danger">
					<?php echo validation_errors(); ?> 						
			 </div>
		<?php endif ?>
		<!-- fin MOi -->
		  <?php  echo form_open('forum/nouveau_sujet','class = form-horizontal');?> 
		<!-- <form class="form-horizontal" action="http://localhost/biblioplus/forum/nouveau_sujet" method="post" > -->
			<div class="form-group"> 
				<h1> Nouveau topic </h1>
			</div>
			
			<div class="form-group">
				<label for="tsujet" class="col-sm-2 control-label">Sujet</label>
				<div class="col-sm-10">
					<input type="text" class="form-control" maxlength="70" id="tsujet" name="tsujet" placeholder="Sujet">
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Categories</label>
				<div class="col-sm-10">
					<select class="form-control"> 
							<option> Science </option>
							<option> Culture </option>
							<option> Roman </option>
						</select> 
				</div>
			</div>
			
			<div class="form-group">
				<label for="inputEmail3" class="col-sm-2 control-label">Sous-categories</label>
				<div class="col-sm-10">
					<select class="form-control"> 
							<option> La phisyque </option>
							<option> haiti 1992 </option>
							<option> L'amour a un prix </option>
						</select> 
				</div>
			</div>
			
			<div class="form-group">
				<label for="tcontenue" class="col-sm-2 control-label">Message</label>
				<div class="col-sm-10">
					<textarea class="form-control" rows="5" name="tcontenue"></textarea>
				</div>
			</div>
			
			<!-- <div class="form-group">
				 <label for="tsujet" class="col-sm-2 control-label">Sujet</label> -->
				<!-- <div class="col-sm-10">
					<input type="text" class="form-control" name="tdate"
					value="<?php // $datestring = '%Y-%m-%d %h:%i:%s'; $time = NOW(); echo mdate($datestring, $time); ?>" />
				</div>
			</div>   -->
			
			<div class="form-group">
				<div  class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-primary" name="poster" value="nouveau_sujet">
						Poster
					</button>
				</div>
			</div>
			
			
		</form>
	
	
</div>
</body>
</html>