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

    <div class="columns large-3 medium-4 small-12  evenement_rectangle_box "  > 
      <div class="row">                   
                
         <img align="center" src="http://via.placeholder.com/350x200" class="thumbnail" />
     
       <div class="columns large-12 medium-12 small-12">
         <div class="columns large-6 medium-6 small-6" >
           <h4 style="text-align:left;"><?php echo $key->nom; ?></h4>
         </div>
         <div class="columns large-6 medium-6 small-6 ">
          <a data-open="modal_voir_user" href="#">
            <?php if(empty($_SESSION['photo'] )){ ?>
              <img style="position: relative; left: 50px;  border-radius: 50%; " src="<?php echo base_url('assets/avatar/avatar.png'); ?>" width="30px" title="<?php echo $key->pseudo; ?>"  alter="photo utilisateur" />
            <?php } else {?>
             <img  style="border-radius: 50%;"src="<?php echo base_url('assets/avatar/'.$_SESSION['photo']); ?>" class="circle_round_evenement" />
           <?php } ?>
         </a>
       </div>  
     </div>
     <div class="columns large-12 medium-12 small-12">
       <span style="position: relative;  font-style: italic; font-size: 12px;"><?php echo $key->dateEvenement; ?></span>
       <span style="position: relative; left: 100px;  font-style: italic; font-size: 12px;"><?php echo $key->lieuEvenement; ?></span>
     </div>
     <div class="columns large-12 medium-12 small-12">
       <span style="position: relative; left: 150px; font-style: italic; font-size: 12px;"><a data-open="modal_voir_evenement" href="#"><i class="fa fa-plus"></i> Voir plus</a></span>
     </div>

   </div>   
 </div>
<?php endforeach ?>
<?php endif ?>
<!-- <div class="row">
  <div class=" columns large-12 medium-12">
<nav aria-label="Pagination">
  <ul class="pagination text-center">
    <li class="pagination-previous disabled">Previous</li>
    <li class="current"><span class="show-for-sr">You're on page</span> 1</li>
    <li><a href="http://localhost/gitbiblioplus/public_html/event/index" aria-label="Page 2">2</a></li>
    <li><a href="#" aria-label="Page 3">3</a></li>
    <li><a href="#" aria-label="Page 4">4</a></li>
    <li class="ellipsis"></li>
    <li><a href="#" aria-label="Page 12">12</a></li>
    <li><a href="#" aria-label="Page 13">13</a></li>
    <li class="pagination-next"><a href="#" aria-label="Next page">Next</a></li>
  </ul>
</nav>
</div>
</div> -->
</div>





<!-- Commencement modal ajout_evenement -->
<div class="reveal" id="modal_ajout_evenement" data-reveal> 
  <div class="row">
    <div class="columns large-12 medium-12">
      <div class="columns large-12 medium-12">
        <h5>Ajout d'un &eacutev&eacutenement</h5>
      </div>
     <form > 
      <?php echo form_open_multipart('event/ajouter','');?> 
      <div class="columns large-6 medium-6">
        <div class="columns large-12 medium-12">
        <input type="text" name="nomEvent" placeholder="Entrez le nom " class="custom_input">
        <input type="text" name="lieuEvent" placeholder="Lieux/Adresse de " class="custom_input">
        <input type="text" name="dateEvent" class="custom_input">
        <input type="text" name="dateEvent" class="custom_input">
        <input type="text" name="dateEvent" class="custom_input">
        <input type="date" name="dateEvent" class="custom_input">
      </div>
      <div class="columns large-6 medium-6" class="custum_input">
        <input class="fill_button" type="submit" name="addEvent" value="Ajouter"/>  
      </div>
      </div>
      <div class="columns large-6 medium-6">
        <div class=" columns large-12 medium-12">
          <img src="http://via.placeholder.com/350x200"  class="thumbnail" >
        </div>
      <div class="columns large-12 medium-12">
        <label>Description
          <textarea cols="10" name="descEvent" rows="5"></textarea>
        </label>
      </div>         
      </div>

      <?php echo form_close();  ?>
    </form>
    <button class="close-button" data-close aria-label="Close modal" type="button">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
</div>
</div>

<!-- Fin modal ajout_evenement -->

<div class="reveal" id="modal_voir_evenement" data-reveal>
  <div class="rows">
    <div class="columns large-12 medium-12">
      <div class="columns large-12 medium-12">
        <h3>Evenement a ne pas rater</h3>
      </div>
      
      <div class="columns large-9 medium-9">
        <img src="http://via.placeholder.com/350x200"  class="thumbnail" >
      </div>
      <div class="columns large-3 medium-3" style="text-align: left;">
        <div class=" columns large-12 medium-12">
         <h4><?php echo $key->dateEvenement; ?></h4>         
        </div>
        <div class=" columns large-12 medium-12">
         <h3><?php echo $key->nom; ?></h3>         
        </div>
        <div class=" columns large-12 medium-12">
         <h5> Ceer par <?php echo $key->pseudo; ?></h5>         
        </div>
      </div>
      <div class="columns large-9 medium-9">
        <p><?php echo $key->lieuEvenement; ?></p>
      </div>
      <div class="columns large-3 medium-3">
        
      </div>
      <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
</div>

<div class="reveal" id="modal_voir_user" data-reveal>
  <div class="rows">
    <div class="columns large-12 medium-12">    
      <h1>USER PROFIL</h1>
      <button class="close-button" data-close aria-label="Close modal" type="button">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
</div>



</body>
</html>