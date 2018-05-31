<?php if (isset($_SESSION['flash'])): ?>
	<?php foreach ($_SESSION['flash'] as $type => $message):?>
	   <div class="alert alert-<?= $type; ?>">
	      <?= $message; ?>            
	   </div>
	<?php endforeach ?>
	<?php unset($_SESSION['flash']) ?>
<?php endif ?>

<div class="row">   
		<div class=" columns large-12 medium-12" style="position: relative; top: 30px; margin: 0px;">
			<div class=" columns large-6 medium-6">
				<h3 style="font-size:28px;">Le calendrier des &eacutev&eacutenements litteraires</h3>
			</div>
			<div class="columns large-6 medium-6" style="text-align: right;">

        
				<a  data-open="modal_ajout_evenement" ><i class="fa fa-plus-square"></i> Ajouter un nouvel &eacutev&eacutenement</a>
			</div>
		</div>
		<?php $req = $this->event->lister(); ?>
      <?php if($req): ?>
        <?php foreach ($req as $key ): ?>
   
            <div class="columns large-3 medium-4 small-12 " style="position: relative; top: 80px;" >    
                   <img src="http://via.placeholder.com/350x200"/>
                   <div class="columns large-12 medium-12">
                   <div class="columns large-6 medium-6">
                   <h4 style="text-align:left;"><?php echo $key->nom; ?></h4>
                   </div>
         <div class="columns large-6 medium-6 ">
          <a href="">
          <?php if(empty($_SESSION['photo'] )){ ?>
            <img style="position: relative; border-radius: 50%; float: right;" src="<?php echo base_url('assets/avatar/avatar.png'); ?>" width="30px" title="<?php echo $key->pseudo; ?>"  alter="photo utilisateur" />
          <?php } else {?>
             <img  style="border-radius: 50%;"src="<?php echo base_url('assets/avatar/'.$_SESSION['photo']); ?>" class="circle_round_evenement" />
          <?php } ?>
          </a>
          </div>  
                   </div>
                   <div class="columns large-12 medium-12">
                     <span style="position: relative; float: left; font-style: italic; font-size: 12px;"><?php echo $key->dateEvenement; ?></span>
                     <span style="position: relative; float: right; font-style: italic; font-size: 12px;"><?php echo $key->lieuEvenement; ?></span>
                   </div>
                  
            
    </div>
    <?php endforeach ?>
      <?php endif ?>


</div>

<!-- Commencement modal ajout_evenement -->
      <div class="reveal" id="modal_ajout_evenement" data-reveal>
  

<div class="row">
  
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
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<!-- Fin modal ajout_evenement -->
</body>
</html>