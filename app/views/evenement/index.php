<?php if (isset($_SESSION['flash'])): ?>
	<?php foreach ($_SESSION['flash'] as $type => $message):?>
	   <div class="alert alert-<?= $type; ?>">
	      <?= $message; ?>            
	   </div>
	<?php endforeach ?>
	<?php unset($_SESSION['flash']) ?>
<?php endif ?>

<div class="row"  >

	

		<div class=" columns large-12 medium-12" style="position: relative; top: 30px; margin: 0px;">
			<div class=" columns large-6 medium-6">
				<h3 style="font-size:28px;">Le calendrier des &eacutev&eacutenements litteraires</h3>
			</div>
			<div class="columns large-6 medium-6" style="text-align: right;">
				<a href="<?php echo base_url('event/ajouter');?>"><i class="fa fa-plus-square"></i> Ajouter un nouvel &eacutev&eacutenement</a>
			</div>
		</div>
		<?php $req = $this->event->lister(); ?>
			<?php if($req): ?>
				<?php foreach ($req as $key ): ?>
		<div class="columns large-12 medium-12" style="position: relative; top: 35px; margin-bottom: 2px;">
		<div class="columns large-6 medium-6 small-12" style="position: relative;">
			
			<div class="columns large-6 medium-6">
				   
		 <div class="columns large-12 medium-12 " style="position: absolute;">
		 	<a href="">
          <?php if(empty($_SESSION['photo'] )){ ?>
            <img style="position: relative; border-radius: 50%; right:15px;" src="<?php echo base_url('assets/avatar/avatar.png'); ?>" width="50px" title="<?php echo $key->pseudo; ?>"  alter="photo utilisateur" />
          <?php } else {?>
             <img  style="border-radius: 50%;"src="<?php echo base_url('assets/avatar/'.$_SESSION['photo']); ?>" class="circle_round_evenement" />
          <?php } ?>
          </a>
        </div>


					<a href="event/desc">
			<img src="http://via.placeholder.com/350x200" class="circle_rectangle">	</a>
			</div>
			<div class="columns large-6 medium-6">
                   <div class="columns large-12 medium-12">
                   	<p>
                       <?php echo $key->nom; ?>
                     </p>
                     <p>
                       <?php echo $key->description; ?>
                     </p>
                     <span style="position: relative; float: left; font-style: italic; font-size: 12px;">
                     	<?php echo $key->dateEvenement; ?>
                     </span>
                     <span style="position: relative; float: right; font-style: italic; font-size: 12px;">
                     	<?php echo $key->lieuEvenement; ?>
                     </span>                                    
                   </div>
                   <div class="columns large-12 medium-12">
                   <a style="position: relative; float: right; font-size: 10px;"><i class="fa fa-plus"></i> Info plus</a>
                   </div>
                   <div class="columns large-12 medium-12">
             <input style="width: 30px; position: relative; float: right; font-size: 10px;  outline: none;" type="text" name=""  >
                  
             <input style="position: relative; float: right; font-size: 10px; outline: none;" type="button" name="" value="Interresé" >
                   </div>				
			</div>
		</div>
		<div class="columns large-5 medium-5">
		 <div class="columns large-12 medium-12 ">
		 	<a href="">
          <?php if(empty($_SESSION['photo'] )){ ?>
            <img style="border-radius: 50%;" src="<?php echo base_url('assets/avatar/avatar.png'); ?>" width="50px" title="<?php echo $key->pseudo; ?>" alter="photo utilisateur"/>
          <?php } else {?>
             <img style="border-radius: 50%;" src="<?php echo base_url('assets/avatar/'.$_SESSION['photo']); ?>" class="circle_round_evenement" />
          <?php } ?>
          </a>
        </div>
        <div class="columns large-12 medium-12">
        	<hr/>
        </div>				
		
		</div>
		
	</div>

		<?php endforeach ?>
			<?php endif ?>
</div>
</body>
</html>