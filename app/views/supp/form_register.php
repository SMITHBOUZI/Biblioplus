  

   <div class="row" id="inscription" >
<div class="columns small-12 medium-7 large-5 medium-centered">  

    <!-- REGISTRATION FORM -->
     <?php if (validation_errors()): ?> 
       <div class="alert alert-danger">
          <?php echo validation_errors(); ?> 
       </div>
      <?php endif ?>

<?php if (isset($_SESSION['flash'])): ?>
    <?php foreach ($_SESSION['flash'] as $type => $message):?>
      <div class="callout <?= $type; ?>" data-closable id="token" style="position: relative; margin:auto; width: 400px;">
        <p><?= $message; ?></p>
         <button class="close-button" aria-label="Dismiss alert" type="button" data-close>
          <span aria-hidden="true">&times;</span>
        </button>        
      </div>
    <?php endforeach ?>
  <?php unset($_SESSION['flash']) ?>
<?php endif ?>

   <!-- <form class="columns medium-12 large-12" > -->
    <?php echo form_open_multipart('login/Sign_up','class="columns medium-12 large-12"');?> 
   <div class="columns small-12 medium-12 "> 
   <h5>Nouveau compte</h5>
 </div>
     
     <div class="columns small-12 medium-12 "> 
    <input type="text" name="nom_prenom" placeholder="Nom complet" class="custom_input" />
    </div>

     <div class="columns small-12 medium-12 "> 
    <input type="text" name="pseudo" placeholder="Nom d'utilisateur" class="custom_input" />
    </div>

     <div class="columns small-12 medium-12"> 
   <!--  <input type="password" name="mailRec" placeholder="Nouveau mot de passe" class="custom_input" /> -->
    <?php echo form_password('mot_de_passe','','class="custom_input" aria-describedby="passwordHelpText" id="mot_de_passe" placeholder="Mot de passe"'); ?>
    </div>
    <div class="columns small-12 medium-12 "> 
    <!-- <input type="password" name="mailRec" placeholder="Confirmation du mot de passe" class="custom_input" /> -->
    <?php echo form_password('mot_de_passe_c','','class="custom_input" aria-describedby="passwordHelpText" id="mot_de_passe_c" placeholder="Confirmation du mot de passe" ') ?>
    </div>
 
    <div class="columns small-12 medium-12 "> 
    <input type="mail" name="email" id="email" placeholder="Votre adresse mail" class="custom_input" />
    </div>

    <div class="columns small-12 medium-12 "> 
    <input type="tel" name="telephone" id="telephone" placeholder="Votre numero de contact" class="custom_input" />
    </div> 

    <div class="columns small-12 medium-12 "> 
      <div class="columns large-12">
      <span>Date naissance</span>
    </div>
    <input type="date" name="date_naissance" class="custom_input" />
    </div> 
 
      <div class="columns small-12 medium-12">
        <select id="sexe" name="sexe">                     
          <option value="Masculin" <?php echo  set_select('sexe', 'Masculin', FALSE); ?>>Masculin</option>
          <option value="Feminin" <?php echo  set_select('sexe', 'Feminin', FALSE); ?> >Feminin</option>
        </select>
    </div>

    <div class="columns small-12 medium-12 " style="margin-top:10px; "> 
    
 
     <div class="columns large-12">
      <span>Inscrire en tant que</span>
</div>

  <div class="columns large-6 small-6" >
    <input type="radio" name="mem" value="Auteur"  id="mem"><label for="mem">Auteur</label>
  </div>

  <div class="columns large-6 small-6">
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


    <div class="columns small-12 medium-12 "> 
    <input type="Submit" name="save" value="Valider" class="fill_button" />
    </div>
<!-- </form> -->
<?php echo form_close();  ?>
</div>
</div>




<!-- 

       <script src="../../assets/node_modules/jquery/dist/jquery.js"></script>
                  <script src="../../assets/node_modules/what-input/dist/what-input.js"></script>
                  <script src="../../assets/node_modules/foundation-sites/dist/js/foundation.js"></script>
                  <script src="../../assets/js/app.js"></script> -->
                </body>
              </html>
       