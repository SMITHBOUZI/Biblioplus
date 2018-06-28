 <?php if (isset($_SESSION['flash'])): ?>
  <?php foreach ($_SESSION['flash'] as $type => $message):?>
    <div class="alert alert-<?= $type; ?>">
     <?= $message; ?>            
   </div>
 <?php endforeach ?>
 <?php unset($_SESSION['flash']) ?>
<?php endif ?>
  
  <div class="row">             

      <div class=" columns large-12 medium-12" style="margin-top: 15px;">
       <div class=" columns large-6 medium-6">
        <h3 style="font-size:28px;">Le calendrier des &eacutev&eacutenements litteraires</h3>
      </div>

      <div class="columns large-6 medium-6" style="text-align: right;">        
        <a  data-open="modal_ajout_evenement" >
          <?php if ($this->session->userdata('pseudo') !== NULL) : ?>
          <i class="fa fa-plus-square"></i> Ajouter un nouvel &eacutev&eacutenement
        <?php endif ?>
        </a>
      </div>

    </div>

    <div class="row small-up-1 medium-up-3 large-up-4 " align="center" style="margin: 0px;" >
          <?php $req = $this->evenement_model->lister(); ?>
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
                  <img style="border-radius: 50%;" src="<?php echo base_url('assets/avatar/avatar.png'); ?>" width="30px" title="<?php echo $key->pseudo; ?>"  alter="photo utilisateur" />
                <?php } else { ?>
                 <img  style="border-radius: 50%;" src="<?php echo base_url('assets/img/'.$key->photo); ?>" class="circle_round_evenement" />
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
                   <a  href="http://localhost/biblioplus/event/enlever?idevenement=<?php echo $key->idevenement; ?>" title="supprimer votre événement"><i class="fa fa-trash"></i>
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

          <!-- Commencement modal ajout_evenement -->
          <div class="reveal" id="modal_ajout_evenement" data-reveal> 

            <div class="row">
              
                <div class="columns large-12 medium-12">
                  <h5>Ajout d'un &eacutev&eacutenement</h5>
                </div>

              <?php if (isset($_SESSION['flash'])): ?>
              <?php foreach ($_SESSION['flash'] as $type => $message):?>
                <div class="alert alert-<?= $type; ?>">
                 <?= $message; ?>            
               </div>
             <?php endforeach ?>
             <?php unset($_SESSION['flash']) ?>
          <?php endif ?>
                <?php echo form_open_multipart('event/index','class=""');?> 
                <div class="columns large-6 medium-6" align="center">
                  <div class="col-sm-3 text-center">
                    <div class="form-group">
                      <label for="avatar">Ajouter une image descriptif .. </label>
                      <input type="file" id="avatar" name="userfile" style="word-wrap: break-word">
                    </div>
                  </div>
                <div class="columns large-12 medium-12">
                  <label>Description
                    <textarea cols="10" name="descEvent" rows="5"></textarea>
                  </label>
                </div>         
                </div>
                <div class="columns large-6 medium-6">
                  <div class="columns large-12 medium-12">
                  <input type="text" name="titreEvent" placeholder="Entrez le nom " class="custom_input">
                  <input type="text" name="lieuEvent" placeholder="Lieux/Adresse de " class="custom_input">
                  <label>Date debut
                  <input type="datetime-local" name="datedebutEvent" class="custom_input">
                  </label>
                  <label>Date fin
                  <input type="datetime-local" name="datefinEvent" class="custom_input">
                  </label>
                  <label for="Activites">Activites</label>
                  <div class="columns large-12 medium-12 small-12"> 
                  <div class=" columns large-6 medium-6 small-6">
                    <input type="radio" name="activite" value="payant" id="prix" align="left"> Payant </input>
                  </div>
                  <div class=" columns large-6 medium-6 small-6">
                    <input type="radio" name="activite" value="gratuit" id="gratuit" align="right"> Gratuit</input>
                  </div>
                   </div>
                  <div class=" columns large-4 medium-4 small-4" >
                    <label>Prix</label>
                    <input type="number" name="prix" placeholder="GDES HT">
                  </div>
                  <div class=" columns large-8 medium-8 small-8">
                    <label>Point de vente</label>
                    <input type="text" name="pointDevente" placeholder="Entrez un Point de vente">
                  </div>
                  <input class="fill_button" type="submit" id="addEvent" name="addEvent" value="Ajouter"/> 
                </div>
                </div>

                <?php echo form_close();  ?>
              <button class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          
          </div>

          <!-- Fin modal ajout_evenement -->

           <?php $req = $this->evenement_model->lister(); ?>
          <?php if($req): ?>
            <?php foreach ($req as $key ): ?>
<!-- Commencement modal modifie_evenement -->
          <div class="reveal" id="<?php echo $key->idevenement.'evente'; ?>" data-reveal> 

            <div class="row">
              
                <div class="columns large-12 medium-12">
                  <h5>Modification d'un &eacutev&eacutenement</h5>
                </div>

            <?php if (isset($_SESSION['flash'])): ?>
            <?php foreach ($_SESSION['flash'] as $type => $message):?>
              <div class="alert alert-<?= $type; ?>">
               <?= $message; ?>            
             </div>
           <?php endforeach ?>
           <?php unset($_SESSION['flash']) ?>
          <?php endif ?>
                <?php echo form_open_multipart('event/modifier','class=""');?> 
                <div class="columns large-6 medium-6" align="center">
                  <div class="col-sm-3 text-center">
                   <!--  <img class="avatar" src="<?php // echo base_url('assets/img/index.jpeg') ?>">
                    <br><br> -->
                    <div class="form-group">
                      <label for="avatar">Ajouter une image descriptif .. </label>
                      <input type="file" id="avatar" name="userfile" style="word-wrap: break-word">
                    </div>
                  </div>
                <div class="columns large-12 medium-12">
                  <label>Description
                    <textarea cols="10" name="descEvent" value="<?php echo $key->description; ?>" rows="5"></textarea>
                  </label>
                </div>   <?php // echo var_dump($key->idevenement); ?>
                </div>
                <input type="hidden" name="idEvent" value="<?php echo $key->idevenement; ?>">
                <div class="columns large-6 medium-6">
                  <div class="columns large-12 medium-12">
                  <input type="text" name="titreEvent" value="<?php echo $key->titre; ?>" placeholder="Entrez le nom " class="custom_input">
                  <input type="text" name="lieuEvent" value="<?php echo $key->lieuEvenement; ?>"  placeholder="Lieux/Adresse de " class="custom_input">
                  <label>Date debut
                  <input type="datetime-local" name="datedebutEvent" value="<?php echo $key->date_debut; ?>" class="custom_input">
                  </label>
                  <label>Date fin
                  <input type="datetime-local" name="datefinEvent" value="<?php echo $key->date_fin; ?>" class="custom_input">
                  </label>
                  <label for="Activites">Activites</label>
                  <div class="columns large-12 medium-12 small-12"> 
                  <div class=" columns large-6 medium-6 small-6">
                    <input type="radio" name="activite" value="payant" id="prix" align="left"> Payant </input>
                  </div>
                  <div class=" columns large-6 medium-6 small-6">
                    <input type="radio" name="activite" value="gratuit" id="gratuit" align="right"> Gratuit</input>
                  </div>
                   </div>
                  <div class=" columns large-4 medium-4 small-4" >
                    <label>Prix</label>
                    <input type="number" value="<?php echo $key->prix; ?>" name="prix" placeholder="GDES HT">
                  </div>
                  <div class=" columns large-8 medium-8 small-8">
                    <label>Point de vente</label>
                    <input type="text" value="<?php echo $key->point_de_vente; ?>" name="pointDevente" placeholder="Entrez un Point de vente">
                  </div>
                  <input class="fill_button" type="submit" id="addEvent" name="addEvent" value="Modifier"/> 
                </div>
                </div>

              <?php echo form_close();  ?>
              <button class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          
          </div>

          <!-- Fin modal modifier_evenement -->
<?php endforeach ?>
<?php endif ?>


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
