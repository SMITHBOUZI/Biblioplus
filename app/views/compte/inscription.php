  

   <div class="row" id="inscription" style="justify-content:center;">
<<<<<<< HEAD

=======
<div class="columns small-12 medium-7 large-12" style="text-align:center;">  
>>>>>>> 8dbcaa63ade5a8b36ea3647ad89d9acd3ba0bfe4


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
<<<<<<< HEAD
    <?php echo form_open_multipart('login/Sign_up','class="columns  small-12 medium-10 large-9"');?> 
   <div class="columns small-12 large-12 medium-12"  > 
   <h4 >Nouveau compte</h4>
   <hr>

 <div class="row" >
     <div class="columns large-6 small-12"> <!-- gauche -->

    

    <div class="columns small-12 medium-12 "> 
    <label>Nom et pr&eacutenom
    <input type="text" name="nom_prenom" placeholder="Entrez votre nom complet"  />
    </label>
    </div>

     <div class="columns small-12 medium-12 "> 
     <label>Pseudo *
    <input type="text" name="pseudo" placeholder="Nom d'utilisateur"  />
    </label>
    </div>

     <div class="columns small-12 medium-12"> 
     <label>Mot de passe *
      <?php echo form_password('mot_de_passe','','class="c" aria-describedby="passwordHelpText" id="mot_de_passe" placeholder="Mot de passe"'); ?>
    </div>
    <div class="columns small-12 medium-12 ">
    <label>Re-entrez le mot de passe *
      <?php echo form_password('mot_de_passe_c','','aria-describedby="passwordHelpText" id="mot_de_passe_c" placeholder="Confirmation du mot de passe" ') ?>

      </label>
    </div>
 
    <div class="columns small-12 medium-12 " > 
    <label>Email *
    <input type="text" name="email"  placeholder="Votre adresse mail"  />
    </label>
    </div>
    
    <div class="columns small-12 medium-12 "> 
    <label>Telephone
    <input type="tel" name="telephone" id="telephone" placeholder="Votre numero de contact"/>
    </label>
    </div> 
</div> <!-- end gauche -->

   
<div class="columns large-6 small-12" >
    <div class="columns small-12 medium-12 "> 
      
      <label>Date naissance *
    
    <input type="date" name="date_naissance"  />
    </label>
    </div> 
 
      <div class="columns small-12 medium-12">
      <label>
      Choisissez votre sexe *
=======
    <?php echo form_open_multipart('login/Sign_up','class="columns medium-10 large-9" margin:auto"');?> 
   <div class="columns small-10 large-12 medium-12"  > 
   <h5>Nouveau compte</h5>

 <div class="row">
     <div class="columns large-6"> <!-- gauche -->

    <div class="columns small-12 medium-12">
    <label>Image </label>
    <input type="file" name="userimage" id="userimage" />
    </div> 

    <div class="columns small-12 medium-12 "> 
    <input type="text" name="nom_prenom" placeholder="Nom complet" class="custom_input" />
    </div>

     <div class="columns small-12 medium-12 "> 
    <input type="text" name="pseudo" placeholder="Nom d'utilisateur" class="custom_input" />
    </div>

     <div class="columns small-12 medium-12"> 
      <?php echo form_password('mot_de_passe','','class="custom_input" aria-describedby="passwordHelpText" id="mot_de_passe" placeholder="Mot de passe"'); ?>
    </div>
    <div class="columns small-12 medium-12 ">
      <?php echo form_password('mot_de_passe_c','','class="custom_input" aria-describedby="passwordHelpText" id="mot_de_passe_c" placeholder="Confirmation du mot de passe" ') ?>
    </div>
 
    <div class="columns small-12 medium-12 " > 
    <input type="mail" name="email" width="100%" placeholder="Votre adresse mail" class="custom_input" />
    </div>
    
    <div class="columns small-12 medium-12 "> 
    <input type="tel" name="telephone" id="telephone" placeholder="Votre numero de contact" class="custom_input" />
    </div> 
    </div> <!-- end gauche -->

   
<div class="columns large-6" >
    <div class="columns small-12 medium-12 "> 
      <div class="columns large-12">
      <span>Date naissance</span>
    </div>
    <input type="date" name="date_naissance" class="custom_input" />
    </div> 
 
      <div class="columns small-12 medium-12">
>>>>>>> 8dbcaa63ade5a8b36ea3647ad89d9acd3ba0bfe4
        <select id="sexe" name="sexe">                     
          <option value="Masculin" <?php echo  set_select('sexe', 'Masculin', FALSE); ?>>Masculin</option>
          <option value="Feminin" <?php echo  set_select('sexe', 'Feminin', FALSE); ?> >Feminin</option>
        </select>
<<<<<<< HEAD
        </label>
    </div>

     
    
 
     <fieldset class="columns large-12">
      <label> <strong>Inscrire en tant que</strong></label>



    <input type="radio" name="mem" value="Auteur"  id="mem"><label for="mem">Auteur</label>

    <input type="radio" name="mem" value="Simple membre" id="mem">
    <label for="mem">Simple Membre</label>
</fieldset>

      

      <div class="columns small-12 medium-12" style="text-align:center; margin-bottom:15px;">
   <!--  <label>Image </label>
    <input type="file" name="userimage" id="userimage" /> -->

    <label for="userimage" class="fill_button" > <i class="fas fa-camera 4x"></i> Photo de profile</label>
    
    <input type="file" id="userimage" class="show-for-sr" name="userimage" ">
    </div> 

      <div class="columns small-12 medium-12 "> 
<label> 
  A propos de vous
  <textarea placeholder="Une petite description de vous" name="desc"></textarea>
 </label> 
    </div>
</div>

    <div class="columns small-12 medium-12 " align="center"> 
    <input type="Submit" name="save" value="Valider" class="fill_button" width="80%" />
=======
    </div>

    <div class="columns small-12 medium-12 " style="margin-top:10px; "> 
    
 
     <div class="columns large-12">
      <span>Inscrire en tant que</span>
</div>

  <div class="columns large-6 small-6" >
    <input type="radio" name="mem" value="Auteur"  id="mem"><label for="mem">Auteur</label>
  </div>

  <div class="columns large-5 small-6">
    <input type="radio" name="mem" value="Simple membre" id="mem">
    <label for="mem">Simple Membre</label>
  </div>

    </div>    

      <div class="columns small-12 medium-12 "> 
<!-- <label> -->
<!--   A propos de vous -->
  <textarea placeholder="Une petite description de vous" name="desc"></textarea>
<!-- </label> -->
    </div>
</div>

    <div class="columns small-12 medium-12 "> 
    <input type="Submit" name="save" value="Valider" class="fill_button" />
>>>>>>> 8dbcaa63ade5a8b36ea3647ad89d9acd3ba0bfe4
    </div>
     </div>
<!-- </form> -->
<?php echo form_close();  ?>
</div>
</div>
</div>


<!-- 

       <script src="../../assets/node_modules/jquery/dist/jquery.js"></script>
                  <script src="../../assets/node_modules/what-input/dist/what-input.js"></script>
                  <script src="../../assets/node_modules/foundation-sites/dist/js/foundation.js"></script>
                  <script src="../../assets/js/app.js"></script> -->
                </body>
              </html>
       