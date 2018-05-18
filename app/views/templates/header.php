<!doctype html>

<html class="no-js" lang="en">
  <head>
      <meta charset="utf-8">
            <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>BiBlioPlus</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/app.css'); ?> ">
        <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
        <link href="https://fonts.googleapis.com/css?family=Barlow+Condensed|Bevan|Carter+One|Fira+Sans+Extra+Condensed|Fjalla+One|Fredoka+One|Hind+Madurai|Oswald|Palanquin+Dark|Paytone+One|Ramabhadra|Suez+One" rel="stylesheet">

  </head>

<body>
 <header>

       <div class="grid-container" > 

        <div class="grid-x ">
        <button class="menu-icon show-for-small-only"></button>   
                 <div class="cell medium-12 large-2  small-2" style="text-align:center;">
                  <div id="logo" ><img src="<?php echo base_url('assets/img/BPlogo.png'); ?>" style="max-width:160px;"></div>

                </div>
                
                <nav class="cell small-10 medium-9 large-8 ">

                  <ul class="  menu align-center"  id="nav_menu">
                    <li><a href="<?php echo base_url('login/index'); ?>"><i class="fas fa-home " ></i></a></li>
                    <li><a href="#">Collection</a></li>
                    <li><a href="#">Auteurs</a></li>
                    <li><a href="#">Evenements</a></li>
                    <li><a href="<?php echo base_url('forum/index'); ?>">Forum</a></li>
                    
                    
                  </ul>
                  
                </nav>


                 <div class="cell small-4  medium-2 large-2">
                  <section class="menu align-center" style="padding:0px;" id="search_login">

                <li><a  id="login"><i class="fas fa-user-circle  ">
                   

              </i></a></li>

<?php if ($this->session->userdata('pseudo') === NULL) : ?>

  <!-- login connect-->

  <div id="login_box" >
    <div id="user" > <!-- Drop down login_box -->
      <?php  echo form_open('login/sign_in', "class='myclass'" ); ?> 
        <div class="grid-container">
          <div class="grid-x padding-x">

            <div class="cell medium-12">
              

              <h6>Connexion</h6>

              <!--  <input type="text" placeholder="Nom d'utilisateur" > -->
              <?php echo form_input('pseudo','','class="custom_input" id="pseudo" placeholder="Nom d\'utilisateur" '); ?>
            </div>
            <div class="medium-12 cell">        
              <!-- <input type="text" placeholder="Mot de Passe" > -->
              <?php echo form_password('mot_de_passe','','class="custom_input" id="mot_de_passe" placeholder="Mot de passe" ') ?>
            </div>

            <div class="medium-12 cell">
              <input type="submit" class="fill_button" name="sign_in" value="Connecter"> </button>
            <!--  <input type="submit" class="fill_button" value="Connecter"> </button> -->
            </div>

            <div class="medium-12 cell">
              <a href="<?php echo base_url('login/sign_up'); ?>">
                <input type="button" class="fill_button" value="Nouveau compte " />
              </a> 
            </div>
            <div class="medium-9 cell"> 
              <span> <a href="<?php echo base_url('account/pass_fotgot'); ?>"> Mot de passe oubli&eacute?</a></span>
              <!--  <span> <a href="#"> Mot de passe oubli&eacute?</a></span> -->
            </div>
          </div>
        </div> <!-- end of container dropdown -->
      <?php echo form_close(); ?>
    </div> 
  </div> <!-- end of dropdown_login  --> 

  <!-- end login connect -->
<?php endif ?>

<?php if ($this->session->userdata('pseudo') !== NULL) : ?>

  <!-- user connect -->

  <div id="login_box" >

    <div id="user" > <!-- Drop down login_box -->
      <form >
        <div class="grid-container">
          <div class="grid-x padding-x">

            <div class="cell medium-12 ">
              <?php if(empty($_SESSION['photo'] )){ ?>
                <img src="<?php echo base_url('assets/avatar/avatar.png'); ?>" />
              <?php } else {?>
                 <img src="<?php echo base_url('assets/avatar/'.$_SESSION['photo']); ?>" />
              <?php } ?>
            </div>

            <div class="medium-12 cell">
              <h6><?php echo $_SESSION['pseudo']; ?> </h6>
             <a href="<?php echo base_url('account/sign_out'); ?>"> 
              <input type="button" name="account/sign_out" value="Deconnexion" class="fill_button" />
             </a> 
            </div> 

          </div>
        </div> <!-- end of container dropdown -->
      </form>
    </div>   
  </div><!-- end of dropdown_login  -->

  <!-- end user connect -->
<?php endif ?>   

        <li><a id="search_button" ><i class="fas fa-search" ></i></a></li>
            <div id="search_box" ><!-- Drop down search -->

   <div id="search" > 
<form >
  <div class="grid-container">
    <div class="grid-x padding-x">
    

      <div class="medium-12 cell">
        
          <input class="custom_input" type="text" placeholder="Rechercher" >
        
      </div>
      

    </div>
  </div>
</form>

 </div>   
    
           </div> <!-- End of dropdwown_search -->

     </section> <!-- end of section menu -->


      
                      </div>

                    </div>

             <!--end of grid-->
          </div><!--end of grid-container-header-->
      </header>

  </div>

  <!--C Moi -->
              <?php if (isset($_SESSION['flash'])): ?>
                <?php foreach ($_SESSION['flash'] as $type => $message):?>
                  <div class="callout success<?= $type; ?>" style="position: absolute;">
                    <?= $message; ?>            
                  </div>
                <?php endforeach ?>
                <?php unset($_SESSION['flash']) ?>
              <?php endif ?>
              <!-- fin MOi -->

<script src="<?php echo base_url('assets/node_modules/jquery/dist/jquery.js'); ?>  "></script>
<script src="<?php echo base_url('assets/node_modules/what-input/dist/what-input.js'); ?>  "></script>
<script src="<?php echo base_url('assets/node_modules/foundation-sites/dist/js/foundation.js'); ?>  "></script>
<script src="<?php echo base_url('assets/js/app.js'); ?> "></script>