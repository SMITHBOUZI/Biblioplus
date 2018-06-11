 <?php // base_url(). include('templates/header.php');?>
 <div class="grid-x" > <!-- begin of banner photo -->
          <div class="cell large-12 medium-12" style="min-height:100px;" id="banner">
               

<div class="row">

          <h2>Bienvenue sur la plateforme Biblioplus</h2>
        <p>Le point d'intersection entre auteurs 
           et les amants du livres </p> 
          

<!-- 
<div class="columns large-12" style="text-align:center;">
              <button class="fill_button" href="#" >
              Discuter sur le forum 
              <i class="fas fa-arrow-right"></i></button>

              </div> -->

          </div>  
                  </div> 
                  </div>

    <div class="grid-container">
              <div class="grid-x ">
                  <div class="cell small-12 large-12" style=" margin-top:2em; 
                  text-align:center;" >
      <h3>D&eacutecouvrez notre catalogue  </h3>
      <p>Des livres de tous genres: Romans,Historique,Scientifiques</br>
      Rien que pour le plaisir de vos yeux </p>
                      
      </div>
      
   
    </div>
    </div> <!-- end of gridC -->
    <!--Catalogue Ouvrage-->
   <div class="row">

<div class="owl-carousel owl-theme">


 <div class="items" >
      <img src="<?php echo base_url('assets/img/ouvrage.jpg'); ?>" class="thumbnail" alt="">
    </div>
   
    <div class="items" >
      <img src="<?php echo base_url('assets/img/ouvrage.jpg'); ?>" 
      class="thumbnail" alt="Banner image">
    </div>
  <div class="items" >
      <img src="<?php echo base_url('assets/img/auteur_homme.jpg'); ?>" class="thumbnail" alt="">
    </div>
  <div class="items" >
      <img src="<?php echo base_url('assets/img/ouvrage.jpg'); ?>" class="thumbnail" alt="">
    </div>
</div>

</div>
     
          <div class="row">

              <div class="columns large-12" style="text-align:center;">
              <button class="fill_button" href="#" >
              Vers tous les ouvrages 
              <i class="fas fa-arrow-right"></i></button>

              </div>
               </div>
             
 
             
         <!-- TOP 3 AUTEURS -->
<div class="auteur_setion">

<div class="row" >
<div class="columns medium-12"> <h3>Les auteurs de la semaine</h3> </div>

<div  class="columns medium-4">
  <div class="columns medium-12" style="text-align:center;"> <img src="<?php echo base_url('assets/img/auteur_femme.jpg') ?>"
  class="circle_round" /> </div>

<h4>Nom_auteur</h4>
<div class="columns medium-12">
  <p> Une petite description concernant l'auteur en question </p>
</div>

</div>

<div  class="columns medium-4">
  <div class="columns medium-12" style="text-align:center;"> <img src="<?php echo base_url('assets/img/auteur_homme.jpg');?> "
  class="circle_round" /> </div>

<h4>Nom_auteur</h4>
<div class="columns medium-12">
  <p> Une petite description concernant l'auteur en question </p>
</div>

</div>

<div  class="columns medium-4">
  <div class="columns medium-12" style="text-align:center;"> <img src="<?php echo base_url('assets/img/auteur_femme.jpg');?> "
  class="circle_round" /> </div>

<h4>Nom_auteur</h4>
<div class="columns small-12 medium-12">
  <p> Une petite description concernant l'auteur en question </p>
</div>

</div>




</div>
</div>


<div id="section_evenement">
  <div class="row">
    <div class="columns large-12 medium-12" style=" margin-top:2em; text-align:center;">
      <h3>Les &eacutev&eacutenements les plus proches</h3>
      <p>Amant du livre, vous qui ne voulez pas manquer un &eacutev&eacutenement auxquels vous voudriez prendre part<br/> dans cette section vous resterez informer.</p>                      
    </div> 

   <!--  <?php $req = $this->event->lister(); ?>
      <?php if($req): ?>
        <?php foreach ($req as $key ): ?> -->
    <div class="columns large-4 medium-6 small-12   evenement_rectangle_box_index" align="center"  > 
                          
                    
             <img src="http://via.placeholder.com/350x200" class="thumbnail" />
         
           <div class="columns large-12 medium-12 " align="center">
             <div class="columns large-6 medium-6 small-6" >
               <h4 style="text-align:left;"><?php echo $key->titre; ?></h4>
             </div>
             <div class="columns large-6 medium-6 small-6 " align="right">
              <a data-open="modal_voir_user" href="#">
                <?php if(empty($_SESSION['photo'] )){ ?>
                  <img style="  border-radius: 50%; " src="<?php echo base_url('assets/avatar/avatar.png'); ?>" width="30px" title="<?php echo $key->pseudo; ?>"  alter="photo utilisateur" />
                <?php } else {?>
                 <img  style="border-radius: 50%;"src="<?php echo base_url('assets/avatar/'.$_SESSION['photo']); ?>" class="circle_round_evenement" />
               <?php } ?>
             </a>
           </div>  
         </div>
         <div class="columns large-12 medium-12 small-12">
         <div class="columns large-6 medium-6 small-6" align="left">      
           <span style="  font-style: italic; font-size: 12px;"><?php echo $key->date_debut; ?></span>
          </div>
           <div class="columns large-6 medium-6 small-6" align="right">
           <span style="  font-style: italic; font-size: 12px;"><?php echo $key->lieuEvenement; ?></span>
         </div>
         </div>
         <div class="columns large-12 medium-12" align="right">
         <span style="font-style: italic; font-size: 12px;"><a data-open="modal_voir_evenement" href="#"><i class="fa fa-plus"></i> Voir plus</a></span>
       </div>
     </div>

    <?php endforeach ?>
      <?php endif ?>

    <?php //$req = $this->event->lister(); ?>
      <?php //if($req): ?>
        <?php //foreach ($req as $key ): ?>
   
            <div class="columns large-4 medium-6 small-12 " >    
                   <img src="http://via.placeholder.com/350x200" class="circle_rectangle" />
                   <div class="columns large-12 medium-12">
                   <div class="columns large-6 medium-6">
                   <h4 style="text-align:left;"><?php //echo $key->nom; ?></h4>
                   </div>
                   <div class="columns large-6 medium-6 ">
      <a href="">
          <?php //if(empty($_SESSION['photo'] )){ ?>
            <img style="position: relative; border-radius: 50%; float: right;" src="<?php echo base_url('assets/avatar/avatar.png'); ?>" width="30px" title="<?php //echo $key->pseudo; ?>"  alter="photo utilisateur" />
          <?php //} else {?>
             <img  style="border-radius: 50%;"src="<?php// echo base_url('assets/avatar/'.$_SESSION['photo']); ?>" class="circle_round_evenement" />
          <?php// } ?>
          </a>
</div>  
                   </div>
                   <div class="columns large-12 medium-12">



                     <span style="position: relative; float: left; font-style: italic; font-size: 12px;"><?php// echo $key->dateEvenement; ?></span>
                     <span style="position: relative; float: right; font-style: italic; font-size: 12px;"><?php// echo $key->lieuEvenement; ?></span>

                   </div>
            
    </div>
    <?php //endforeach ?>
      <?php //endif ?>
  </div>
</div>

<!-- Begining of footer -->

