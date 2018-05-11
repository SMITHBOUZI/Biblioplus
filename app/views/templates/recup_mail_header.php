 
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
                          <li><a href="#"><i class="fas fa-home " ></i></a></li>
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

<!-- pass forgot -->
<?php if ( base_url('http://localhost/gitbiblioplus/Biblioplus/account/pass_fotgot')) : ?>

<div id="login_box" >
  <div id="user" > <!-- Drop down login_box -->
    <?php  echo form_open('account/Pass_fotgot', "class='myclass'" ); ?> 
      <div class="grid-container">
        <div class="grid-x padding-x">

          <div class="cell medium-12">
            <!--C Moi -->
             <?php if (validation_errors()): ?> 
               <div class="alert alert-danger">
                  <?php echo validation_errors(); ?>            
               </div>
              <?php endif ?>
            <!-- fin MOi -->
            <!--C Moi -->
            <?php if (isset($_SESSION['flash'])): ?>
              <?php foreach ($_SESSION['flash'] as $type => $message):?>
                <div class="alert alert-<?= $type; ?>">
                  <?= $message; ?>            
                </div>
              <?php endforeach ?>
              <?php unset($_SESSION['flash']) ?>
            <?php endif ?>
            <!-- fin MOi -->

            <h6>Entre votre addresse mail</h6>

            <!--  <input type="text" placeholder="Nom d'utilisateur" > -->
            <?php echo form_input('email','','class="form-control" id="email" placeholder="Email de recuperation" '); ?>
          </div>

          <div class="medium-12 cell">
            <input type="submit" class="fill_button" name="Pass_fotgot" value="Envoyer"> </button>
          <!--  <input type="submit" class="fill_button" value="Connecter"> </button> -->
          </div>

          <div class="medium-9 cell"> 
            <span> <a href="<?php echo base_url('login/sign_in'); ?>"> Seconnecter </a></span>
            <!--  <span> <a href="#"> Mot de passe oubli&eacute?</a></span> -->
          </div>
        </div>
      </div> <!-- end of container dropdown -->
    <?php echo form_close(); ?>
  </div> 
</div><!-- end of dropdown_login  --> 

<?php endif ?>

<!-- end pass forgot -->    

        <li><a id="search_button" ><i class="fas fa-search" ></i></a></li>
            <div id="search_box" ><!-- Drop down search -->

   <div id="search" > 
<form >
  <div class="grid-container">
    <div class="grid-x padding-x">
    

      <div class="medium-12 cell">
        
          <input type="text" placeholder="Rechercher" >
        
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

  <script src="<?php echo base_url('assets/node_modules/jquery/dist/jquery.js'); ?>  "></script>
  <script src="<?php echo base_url('assets/node_modules/what-input/dist/what-input.js'); ?>  "></script>
  <script src="<?php echo base_url('assets/node_modules/foundation-sites/dist/js/foundation.js'); ?>  "></script>
  <script src="<?php echo base_url('assets/js/app.js'); ?> "></script>


  