
 <div class="grid-x" > <!-- begin of banner photo -->
  <div class="cell large-12 medium-12" style="min-height:100px;" id="banner">
<div class="row">
      <h2>Bienvenue sur la plateforme Biblioplus</h2>
    <p>Le point d'intersection entre auteurs et les amants du livres </p> 
</div>  
    </div> 
    </div>

    <div class="grid-container">
        <div class="grid-x ">
          <div class="cell small-12 large-12" style=" margin-top:2em;  text-align:center;" >
      <h3>D&eacutecouvrez notre catalogue  </h3>
      <p>Des livres de tous genres: Romans, Historique, Scientifiques</br>
      Rien que pour le plaisir de vos yeux </p>
                      
      </div>   
    </div>
    </div> <!-- end of gridC -->
    <!--Catalogue Ouvrage-->
   <div class="row">

<div class="columns small-12">
  <div class="owl-carousel owl-theme" style="border-top:1.6px solid #309958; padding-top:10px;">

    <?php $livres = $this->Collection_model->index_livres(); ?>
    <?php  foreach($livres as $rows): ?>
      <div class="items" >
        <a href="#" data-open="<?php echo 'modalInfoOuvrage'.$rows->idouvrage; ?>">
        <img src="<?php echo base_url('assets/img/'.$rows->images); ?>" class="thumbnail" alt="" />
        </a>
      </div>

<!-- modal infoOuvrage Romans -->
<div class="reveal large" id="<?php echo 'modalInfoOuvrage'.$rows->idouvrage; ?>" data-reveal>

<div class="row" style="padding:2em; background-color:#ececec; justify-content:center;">

<div class="columns medium-12 " style="margin-top:1em;">

<div class="columns medium-12" style="text-align:center;">
<h5 style="margin:0px"><strong><?php echo $rows->titre; ?></strong></h5>
Publier par : <?php echo $rows->pseudo; ?> <br />
Email : <?php echo $rows->email; ?>
</div>

<div class="columns medium-6 small-12 large-3">
<img src="<?php echo base_url('assets/img/'.$rows->images); ?>" style="width:240px; height:290px;" alt="" class="thumbnail"/>

</div>

<div class="columns medium-9" >


<div class="columns medium-12">
<strong>Description </strong> 
</div>
<div class="columns medium-12"><p>
<?php echo $rows->description; ?></p>

</div>

<div class="row" style="border: 1px solid white ">
<div class="columns medium-6">
<div class="columns medium-12">
<strong><u>Specifications</u></strong>
</div>
<div class="columns medium-12">
<strong>Langues :</strong><?php echo $rows->langue; ?>
</div>
<div class="columns medium-12">
<strong>Genre :</strong><?php echo $rows->categorie; ?>
</div>
<div class="columns medium-12">
<strong>Edition :</strong><?php echo $rows->edition; ?>
</div>
<div class="columns medium-12">
<strong>ISBN :</strong> <?php echo $rows->isbn; ?>
</div>

<div class="columns medium-12">
<strong>Pages :</strong><?php echo $rows->pages; ?>
</div>

<div class="columns medium-12">
<strong>Point de vente :</strong> <?php echo $rows->point_de_vente; ?>
</div>
</div>
<div class="columns large-5" style="text-align:center; margin-top:2em" >
  <a href="../assets/web/viewer.html?file=<?php echo $rows->livre_path; ?>"> 
     <button class="fill_button" >
        Commencer la lecture 
        <i class="fas fa-book 2x" ></i>
     </button>
  </a>

</div>
</div>

</div>
</div>
</div>
 
<button class="close-button" data-close aria-label="Close reveal" type="button">
<span aria-hidden="true">&times;</span>
</button>
</div>
<!--  fin modalInfoOuvrage Romans-->

    <?php  endforeach ?>
  </div>
</div>

</div> 
     
    <div class="row">
      <div class="columns large-12" style="text-align:center;">
       <a href="http://localhost/biblioplus/collection/index"> 
          <button class="fill_button" href="#" >
          Vers tous les ouvrages <i class="fas fa-arrow-right"></i>
          </button>
        </a>
      </div>
    </div>
             
         <!-- TOP 3 AUTEURS -->
<div class="auteur_setion">
  <div class="row" >
    <div class="columns medium-12"> <h3>Les auteurs de la semaine</h3> </div>
    <?php if ($auteurs) {?>
      <?php foreach ($auteurs as $rows ): ?>
        <div  class="columns medium-4">
          <div class="columns medium-12" style="text-align:center;"> 
            <img src="<?php echo base_url('assets/img/auteur_femme.jpg') ?>" class="circle_round" />
            </div>
            <h4> <?= $rows->pseudo ?></h4>
            <div class="columns medium-12">
              <p> <?= $rows->description; ?></p>
            </div>
        </div>
      <?php endforeach ?>
    <?php } ?>
  </div>
</div>


<div id="section_evenement">
  <div class="row">
    <div class="columns large-12 medium-12" style=" margin-top:2em; text-align:center;">
      <h3>Les &eacutev&eacutenements les plus proches</h3>
      <p>Amant du livre, vous qui ne voulez pas manquer un &eacutev&eacutenement auxquels vous voudriez prendre part<br/> dans cette section vous resterez informer.</p>                      
    </div> 
  </div>
</div>

<div class="row">

   <div class="row small-up-1 medium-up-3 large-up-4 " align="center" style="margin: 0px;" >
          <?php $req = $this->evenement_model->lister_event_index(); ?>
          <?php if($req): ?>
            <?php foreach ($req as $key ): ?>
      <div class="column column-block ">
        <div class="columns large-12 medium-12 small-12 evenement_rectangle_box">
              <div class="columns medium-12" style=" padding: 0px;">
                    
         <?php if(empty($key->photo )){ ?>
              <img src="http://via.placeholder.com/350x200" class="thumbnail" style="width: 350px; height:200px; "  />
            <?php } else {?>
             <img src="<?php echo base_url('assets/img/'.$key->photo); ?>" class="thumbnail" style="width: 350px; height:200px; " />
           <?php } ?>
         </div> 
          <div class="columns large-12 medium-12 " align="center"  style="padding: 0px">
             <div class="columns large-8 medium-8 small-8" style="padding: 0px" >
               <span style="text-align:left;"><?php echo $key->titre; ?></span>
             </div>
           
             <div class="columns large-4 medium-4 small-4 " align="right">
              <a data-open="modal_voir_user" href="<?php echo base_url('auteur/info?id=').$key->idmembre; ?>">
                <?php if(empty($_SESSION['photo'] )){ ?>
                  <img style="border-radius: 50%; width: 30px; height: 30px; " src="<?php echo base_url('assets/avatar/avatar.png'); ?>" title="<?php echo $key->pseudo; ?>"  alter="photo utilisateur" />
                <?php } else { ?>
                 <img  style="border: 0px; width:35px; height:35px;" src="<?php echo base_url('assets/avatar/'.$_SESSION['photo']); ?>" class="circle_round_evenement" />
               <?php } ?>
             </a>
           </div> 

         </div>
         <div class="columns large-12 medium-12 small-12">
         <div class="columns large-6 medium-6 small-6" align="left">      
           <h3 style="  font-style: italic; font-size: 12px;"><strong><?php echo $key->event_mois; ?></strong></h3>
          </div>
           <div class="columns large-6 medium-6 small-6" align="right">
           <span style="  font-style: italic; font-size: 12px;"><?php echo $key->lieuEvenement; ?></span>
         </div>
         </div>
         <div class="columns large-12 medium-12" align="right">
         <span style="font-style: italic; font-size: 12px;">
          <a data-open="<?php echo $key->idevenement.'event'; ?>"><i class="fa fa-plus"></i> Voir plus</a></span>
       </div>
       </div>
      </div>

       <!-- Modal Voir un evenement -->

          <div class="reveal small" id="<?php echo $key->idevenement.'event'; ?>" data-reveal style="border-radius: 3%;">
            <div class="rows"> 
              <div class="columns large-12 medium-12" style="margin: 0px">
            <div class="columns large-12 medium-12" style=" margin: 0px; background-color: #f3f1f1;  
            box-shadow: 0px 0px 3px 0.4px #888888; border-radius: 3%;">       
                <div class="columns large-8 medium-8" style="margin-bottom: -15px; position: relative; right: 30px;" >
                  <!-- <img src="http://via.placeholder.com/350x200"  class="thumbnail" > -->
                   <?php if(empty($key->photo )){ ?>
                      <img src="http://via.placeholder.com/350x200" class="thumbnail" style="width: 200px; height:250px; "  />
                    <?php } else {?>
                     <img src="<?php echo base_url('assets/img/'.$key->photo); ?>" class="thumbnail" style="width: 290px; height:270px; " />
                   <?php } ?>
                </div>
                <div class="columns large-4 medium-4">
                  <div class=" columns large-12 medium-12">
                   <h4><?php echo $key->event_mois; ?></h4>         
                  </div>
                  <div class=" columns large-12 medium-12">
                   <h3><?php echo $key->titre; ?></h3>         
                  </div>
                  <div class=" columns large-12 medium-12">
                   <h5> Ce&eacuter par : <?php echo $key->pseudo; ?></h5>         
                  </div>
                </div>
                </div>
            <?php if ($this->session->userdata('pseudo') !== NULL) : ?>
              <div class=" columns large-12 medium-12" style="border-bottom: 1px solid #f3f1f1; margin-bottom:5px; margin-top: 10px;">
                   <a href="#" data-open="<?php echo $key->idevenement.'evente';  ?>" ><i class="fa fa-edit"></i>modifier &eacutev&eacutevement </a> 
                   <a  href="http://localhost/gitbiblioplus/public_html/event/enlever?idevenement=<?php echo $key->idevenement; ?>" title="supprimer votre événement"><i class="fa fa-trash"></i>
                   Supprimer &eacutev&eacutevement </a>              
              </div>
            <?php endif ?>
                 <!-- fin modal suppression evenement -->
 
                <div class="columns large-7 medium-7" style="margin-top:5px;  word-wrap: break-word; text-align: justify; box-shadow: 0px 0px 1px 0.4px #888888;">
                  <h5>Description</h5> 
                  <?php echo $key->description; ?>
                </div>
                <div class="columns large-5 medium-5" style="margin-top:5px;">
                    <div class="columns large-12 medium-12 small-12">
                    <div class=" columns large-12 medium-12 small-12">
                    <h5>Date et l'Heure</h5>  
                    </div>
                    <div class=" columns large-12 medium-12 small-12">
                       <?php echo $key->event_deb; ?> <br/> <?php echo $key->event_fin; ?>
                    </div>
                    </div>
                    <div class="columns large-12 medium-12 small-12"  style="margin-top: 10px;">
                    <div class=" columns large-12 medium-12 small-12">
                    <h5>Lieu</h5>  
                    </div>
                    <div class=" columns large-12 medium-12 small-12">
                       <?php echo $key->lieuEvenement; ?>
                    </div>
                    <div class=" columns large-12 medium-12 small-12" style="margin-top: 5px;">
                    <div class="columns large-8 medium-8 small-8">
                    <?php if ( $key->activite == 1) { ?>
                    <h5>Activité <?php echo 'Payant'; ?> </h5>
                    <?php } else { ?>
                    <h5>Activité <?php echo 'Gratuit'; ?> </h5>
                      <?php } ?>
                    </div>  
                    
                    <div class=" columns large-4 medium-4 small-4">
                       <?php //echo $key->activite; ?>
                    </div>
                    </div>
                    </div>
                </div>
           
                  <div class="columns large-12 medium-12 small-12">
                 
                  <h5 align="center" style="margin-top: 2px;">Partager avec des amis</h5>  
                  
                  <div class="columns small-12 medium-12" style="margin-top:1em; text-align:center; margin-bottom:5px;">
                  <a><i class="fab fa-facebook-f fa-2x" style="background-color:silver; border-radius:50%;  color:white ; padding:5px; width:30px;height:30px"></i></a>
                  <a><i class="fab fa-google fa-2x" style="background-color:silver; border-radius:50%;  color:white; padding:5px; width:30px;height:30px"></i></a>
                  <a><i class="fab fa-twitter fa-2x" style="background-color:silver; border-radius:50%;  color:white ; padding:5px; width:30px;height:30px"></i></a>
                  <a><i class="fab fa-linkedin fa-2x" style="background-color:silver; border-radius:50%;  color:white; padding:5px; width:30px;height:30px"></i></a>
                  </div>
                  </div>
                <button class="close-button" data-close aria-label="Close modal" type="button">
                  <span aria-hidden="true">&times;</span>
                </button>
                </div>
              </div>
          </div>
          <!-- Modal Voir un evenement -->
          <?php endforeach ?>
          <?php endif ?>

    </div>

    </div>



    </div>
<!-- Begining of footer -->

<?php if ($notifications) : ?>
  <?php foreach ($notifications as $key ) :?>
      <li><a href="#">Notification :</a>
       <?php echo " ".$key->nbr_notify; ?> 
      </li>
      <li><a href="#">Nbre de membre :</a>
       <?php echo " ".$key->membres[0]->nbr_membre; ?> 
      </li>
      <li><a href="#">Nbre de evenement :</a>
       <?php echo " ".$key->event[0]->nbr_event; ?> 
      </li>
      <li><a href="#">Nbre de post :</a>
       <?php echo " ".$key->post[0]->nbr_sujet; ?> 
      </li>
      <li><a href="#">Nbre de ouvrage :</a>
       <?php echo " ".$key->ouvrage[0]->nbr_ouvrage; ?> 
      </li>
    <?php endforeach ?>
<?php endif ?>