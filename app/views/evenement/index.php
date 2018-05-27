<?php if (isset($_SESSION['flash'])): ?>
	<?php foreach ($_SESSION['flash'] as $type => $message):?>
	   <div class="alert alert-<?= $type; ?>">
	      <?= $message; ?>            
	   </div>
	<?php endforeach ?>
	<?php unset($_SESSION['flash']) ?>
<?php endif ?>

<div class="row">
	<div class="columns large-12 medium-12">
		<div class="columns large-12 medium-12 small-12">
			<h3 style="text-align: center;"></h3>
		</div>
		<div class=" columns large-12 medium-12" style="position: relative; top: 10px;">
			<div class=" columns large-6 medium-6">
				<h3 style="font-size:28px;">Le calendrier des &eacutev&eacutenements litteraires</h3>
			</div>
			<div class="columns large-6 medium-6" style="text-align: right;">
				<a href="<?php echo base_url('event/ajouter');?>"><i class="fa fa-plus-square"></i> Ajouter un nouvel &eacutev&eacutenement</a>
			</div>
		</div>

		<div class="columns large-12 medium-12" style="position: relative; top: 35px;">
		<div class="columns large-6 medium-6 small-12">
			<?php $req = $this->event->lister(); ?>
				<?php if($req): ?>
			<div class="columns large-6 medium-6">
				<?php foreach ($req as $key ): ?>
			<img src="http://via.placeholder.com/350x200" class="circle_rectangle">	
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
                   </div>				
			</div>
		</div>
		<div class="columns large-5 medium-5">
		 <div class="cell medium-12 ">
          <?php if(empty($_SESSION['photo'] )){ ?>
            <img src="<?php echo base_url('assets/avatar/avatar.png'); ?>" width="50px" title="<?php echo $key->pseudo; ?>" alter="photo utilisateur"/>
          <?php } else {?>
             <img src="<?php echo base_url('assets/avatar/'.$_SESSION['photo']); ?>" class="circle_round_evenement" />
          <?php } ?>
        </div>

			
				<?php endforeach ?>
			<?php endif ?>
		</div>
		</div>
	</div>
</div>
</body>
</html>