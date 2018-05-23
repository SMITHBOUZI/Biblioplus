<div class="row" id="user">
  <div class="columns  small-12 medium-5 large-5 medium-centered">
  

 
        <?php  echo form_open('login/sign_in', 'class="columns medium-10 large-10"  ' ); ?>

            <div class="columns medium-12 small-12">
                      
             
         

              <h5 style="text-align:center;margin-bottom:1.1em;">Connexion</h5>
              <p>Acceder a votre compte</p>

              <!--  <input type="text" placeholder="Nom d'utilisateur" > -->
              <?php echo form_input('pseudo','','class="custom_input" name="pseudo" id="pseudo" placeholder="Nom d\'utilisateur" '); ?>
            </div>



            <div class="columns large-12">        
          
              <?php echo form_password('mot_de_passe','','class="custom_input" name="mot_de_passe" id="mot_de_passe" placeholder="Mot de passe" ') ?>
            </div>


       <div class="columns large-12"> 
              <span> <a href="<?php echo base_url('account/pass_fotgot'); ?>"> Mot de passe oubli&eacute?</a></span>
              <!--  <span> <a href="#"> Mot de passe oubli&eacute?</a></span> -->
            </div>


             <div class="columns large-12"> 
            <!-- <a href="<?php // echo base_url('login/sign_up'); ?>"> 
               <input type="button" id="" class="fill_button" name="sign_in" value="Connecter" />
            </a> -->
            <input type="Submit" name="sign_in" value="Valider" class="fill_button" />
            </div>
              

               <div class="columns large-12" style="margin-top:0.4em;"> 
             <a href="<?php echo base_url('login/sign_up'); ?>"> 
              <input type="button" id="" class="fill_button" name="sign_up" value="Nouveau compte"/> </a>
              <!--  <span> <a href="#"> Mot de passe oubli&eacute?</a></span> -->
            </div>




            
            
          </div>
        </div> <!-- end of container dropdown -->
      <?php echo form_close(); ?>
 
  <!-- end login connect -->
<?php // endif ?>


