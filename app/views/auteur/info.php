
<div class="row" style="margin-top:1.2em;">

  <div class="columns small-12 medium-12 large-12" style="justify-content:center; border: 2px solid red;">

  <?php foreach ($auteurs as $key ):?>

  <div class="columns small-12 medium-12 large-12">
    <h3>Profil de <?= $key->pseudo; ?> </h3>
  </div>
  <?php endforeach ?>

  <div class="columns large-4 medium-11 small-12" id="infoUtilisateur">
    <?php foreach ($auteurs as $key ):?>

    <div class="columns medium-12 ">
      <?php if(empty($_SESSION['photo'] )){ ?>
      <img src="<?php echo base_url('assets/avatar/avatar.png'); ?>" class="thumbnail" />  
      <?php } else {?>
      <img class="thumbnail" src="<?php echo base_url('assets/avatar/'.$_SESSION['photo']); ?>" />
      <?php } ?>
    </div>
    <div class="columns medium-12">
      <h6><?= $key->nom_prenom; ?>,&nbsp<?= $key->ages; ?> ans</h6>
    </div>

    <div class="columns medium-12" >
      <div class="info">
        <?= $key->status; ?><br />
        Tel : <?= $key->telephone; ?> <br />
        <?= $key->email; ?>
      </div>
      <?php if(  $this->session->userdata('idmembre') === $_GET['id'] ) {?>
      <div id="compte">
        <span class="spanInfoUtilisateur">Compte</span >
        <a href="http://localhost/biblioplus/auteur/ferme_compter?id=<?php echo $key->idmembre; ?>"> 
          <button class="fill_button">Fermer</button>
        </a>
        <a href="http://localhost/biblioplus/auteur/modifier_compte?id=<?php echo $key->idmembre; ?>">

        <a href="#">
         <button class="fill_button" data-open="modal_modifier_compte" >Modifier</button>
        </a>
      </div>
      <?php } ?>
    </div>
  </div>

  <div class="columns medium-11 large-8 small-12">
  <h5>A propos </h5>
  <p align="justify"> <?= $key->description; ?></p>
  <hr/>
    <div class="row" style="text-align:center;justify-content:center;">
      <div class="columns medium-12 large-12 small-12"  >
        <h4> Activit&eacutes</h4>
      </div>
      <?php if( $key->status === 'Auteur' ): ?>
      <?php if (($key->nbr_ouvrage[0]->NBO) > 0 ) { ?>
          <div class="column large-3 medium-4 small-9 ficheOuvrage">
      <a href="http://localhost/biblioplus/collection/ouvrage_membre?id=<?= $key->idmembre; ?>"> <?php } else {  ?>
      <a href="#">
        <?php } ?>
      
          <div class="columns medium-12 large-12 small-12">
            <i class="fas fa-book fa-4x"></i>
          </div>
          <div class="columns medium-12 large-12">
            OUVRAGES</br>
            <strong><?= $key->nbr_ouvrage[0]->NBO; ?></strong>
         </div>
        </div></a>
      
      <?php endif ?>
      <?php if (($key->nbr_event[0]->NBE) > 0 ) { ?>
        <div class="column large-3 medium-3 small-9 ficheOuvrage">
      <a href="http://localhost/biblioplus/event/evenement_membre?id=<?= $key->idmembre; ?>"> <?php } else {  ?>
      <a href="#">
        <?php } ?>
        
          <div class="columns medium-12">
            <i class="fas fa-calendar-alt fa-4x"></i>
          </div>
          <div class="columns medium-12">
            EVENEMENTS</br>
            <strong><?= $key->nbr_event[0]->NBE; ?></strong>
          </div>
        </div>
      </a>
      <?php if (($key->nbr_post[0]->NBP) > 0 ) { ?>
        <div class="column large-3 medium-3 small-9 ficheOuvrage">
      <a href="http://localhost/biblioplus/forum/forum_membre?id=<?= $key->idmembre; ?>"> <?php } else {  ?>
      <a href="#">
        <?php } ?>
        
          <div class="columns medium-12">
            <i class="fas fa-comments fa-4x"></i>
          </div>
          <div class="columns medium-12">
            PUBLICATION</br>
            <strong><?= $key->nbr_post[0]->NBP; ?></strong>
          </div>
        </div>
      </a>
    </div>
  </div>
  <?php endforeach ?>

  </div>
</div>

<!-- debut modal_modifier_compte -->
<div class="reveal small" id="modal_modifier_compte"  data-reveal>

  

   <div class="row" id="inscription" style="justify-content:center;">
<div class="columns small-12 medium-7 large-12" style="text-align:center;">  


    <!-- REGISTRATION FORM -->
     <?php if (validation_errors()): ?> 
       <div class="alert alert-danger">
          <?php echo validation_errors(); ?> 
       </div>
      <?php endif ?>

<?php if (isset($_SESSION['flash'])): ?>
    <?php foreach ($_SESSION['flash'] as $type => $message):?>
      <div class="callout <?= $type; ?>" data-closable id="token" >
        <p><?= $message; ?></p>
         <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
          <span aria-hidden="true">&times;</span>
        </button>        
      </div>
    <?php endforeach ?>
  <?php unset($_SESSION['flash']) ?>
<?php endif ?>

 <!-- <form class="columns medium-12 large-12" > -->
  <?php echo form_open_multipart('auteur/modifier_compte','class="columns medium-10 large-9" margin:auto"');?> 
 <div class="columns small-10 large-12 medium-12"  > 
 <h5> Modifier compte </h5>
<?php foreach ($auteurs as $key => $value) : ?>

  <?php // echo $value->pseudo; ?>
 <div class="row">
     <div class="columns large-6"> <!-- gauche -->

   <!--  <div class="columns small-12 medium-12">
    <label>Image </label>
    <input type="file" name="userimage" id="userimage" />
    </div>  -->
    <input type="hidden" name="id" value="<?= $value->idmembre; ?>" />
      <div class="columns small-12 medium-12">
        <input type="file" id="avatar" name="userimage">
      </div>
    
    <div class="columns small-12 medium-12 "> 
    <input type="text" name="nom_prenom" placeholder="Nom complet" class="custom_input" value="<?php echo $value->nom_prenom; ?>" />
    </div>

     <div class="columns small-12 medium-12 "> 
    <input type="text" name="pseudo" placeholder="Nom d'utilisateur" class="custom_input" value="<?php echo $value->pseudo; ?>" />
    </div>
 
    <div class="columns small-12 medium-12 " > 
    <input type="mail" name="email" placeholder="Votre adresse mail" class="custom_input" value="<?php echo $value->email; ?>" />
    </div>

     <div class="columns small-12 medium-12"> 
      <?php echo form_password('mot_de_passe','','class="custom_input" aria-describedby="passwordHelpText" id="mot_de_passe" placeholder="Mot de passe"'); ?>
    </div>
    <div class="columns small-12 medium-12 ">
      <?php echo form_password('mot_de_passe_c','','class="custom_input" aria-describedby="passwordHelpText" id="mot_de_passe_c" placeholder="Confirmation du mot de passe" ') ?>
    </div>
    
    <div class="columns small-12 medium-12 "> 
    <input type="tel" name="telephone" id="telephone" placeholder="Votre numero de contact" class="custom_input" value="<?php echo $value->telephone; ?>" />
    </div> 
    </div> <!-- end gauche -->
   
  <div class="columns large-6" >
    <!-- <div class="columns small-12 medium-12 "> 
      <div class="columns large-12">
      <span>Date naissance</span>
    </div>
    <input type="date" name="date_naissance" class="custom_input" value="<?php // echo $value->date_naissance; ?>" />
    </div>  -->
 
      <!-- <div class="columns small-12 medium-12">
        <select id="sexe" name="sexe">                     
          <option value="Masculin" <?php // echo  set_select('sexe', 'Masculin', FALSE); ?>>Masculin</option>
          <option value="Feminin" <?php // echo  set_select('sexe', 'Feminin', FALSE); ?> >Feminin</option>
        </select>
    </div> -->

    <div class="columns small-12 medium-12 " style="margin-top:10px; "> 
    
 
     <div class="columns large-12">
      <span>Inscrire en tant que</span>
    </div>

      <div class="columns large-6 small-6" >
        <input type="radio" name="mem" value="<?php echo $value->status; ?>" id="mem"><label for="mem">Auteur</label>
      </div>

      <div class="columns large-5 small-6">
        <input type="radio" name="mem" value="Simple membre" id="mem" value="<?php echo $value->status; ?>">
        <label for="mem">Simple Membre</label>
      </div>
        </div>    

          <div class="columns small-12 medium-12 "> 
    <!-- <label> -->
    <!--   A propos de vous -->
      <textarea placeholder="Une petite description de vous" name="desc" value="<?php echo $value->description; ?>"></textarea>
    <!-- </label> -->
        </div>
    </div>

<?php endforeach ?>

    <div class="columns small-12 medium-12 "> 
    <input type="Submit" name="save" value="Valider" class="fill_button" />
    </div>
     </div>
<!-- </form> -->
<?php echo form_close();  ?>
</div>
</div>
</div>

  </body>
</html>
       
<button class="close-button" data-close aria-label="Close modal" type="button">
  <span aria-hidden="true">&times;</span>
</button>

</div>
 <!-- fin modal_modifier_compte -->