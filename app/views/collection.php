<div class="row" style="padding:2em; text-align:center;">
<div class="columns small-12 medium-12 medium-centered">
<h3>Un catalogue diversifi&eacute</h3>
<p>Diverse ouvrage en format multiple group&eacute par cat&eacutegorie</p>

</div>
<?php   

if (isset($_SESSION['pseudo'])===true) {
	echo '


<p><button class="fill_button" data-open="modal_ajouter_ouvrage">Ajouter un ouvrage</button></p>';

	}
else
	echo'
	<p><button class="fill_button" data-open="modal_connexion">Ajouter un ouvrage</button></p>';

?>



	
<div class="columns small-12">
	<span class="collection_header">Romans</span>
</div>
<div class="columns small-12">
<div class="owl-carousel owl-theme" style="border-top:1.6px solid #309958;padding-top:10px;">


 <div class="items" >
      <img src="<?php echo base_url('assets/img/ouvrage.jpg'); ?>"
       class="thumbnail" alt="">
    </div>
   
    <div class="items" >
      <img src="<?php echo base_url('assets/img/ouvrage.jpg'); ?>" 
      class="thumbnail" alt="Banner image">
    </div>
  <div class="items" >
      <img src="<?php echo base_url('assets/img/auteur_homme.jpg'); ?>"
       class="thumbnail" alt="">
    </div>
  <div class="items" >
      <img src="<?php echo base_url('assets/img/ouvrage.jpg'); ?>" 
      class="thumbnail" alt="">
    </div>


</div>



</div>



<div class="columns small-12">
	<span class="collection_header">Historique</span>
</div>
<div class="columns small-12">
<div class="owl-carousel owl-theme" style="border-top:1.6px solid #309958;padding-top:10px;">


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

<div class="columns small-12">
	<span class="collection_header">Scientifique</span>
</div>
<div class="columns small-12">
<div class="owl-carousel owl-theme" style="border-top:1.6px solid #309958; 
padding-top:10px;">


 <div class="items" >
      <img src="<?php echo base_url('assets/img/ouvrage.jpg'); ?>" 
      class="thumbnail" alt="">
    </div>
   
    <div class="items" >
      <img src="<?php echo base_url('assets/img/ouvrage.jpg'); ?>" 
      class="thumbnail" alt="Banner image">
    </div>
  <div class="items" >
      <img src="<?php echo base_url('assets/img/auteur_homme.jpg'); ?>" 
      class="thumbnail" alt="">
    </div>
  <div class="items" >
      <img src="<?php echo base_url('assets/img/ouvrage.jpg'); ?>" 
      class="thumbnail" alt="">
    </div>


</div>



</div>

<!-- modal for ajouter_ouvrage -->



<!-- This is the first modal -->
<div class="reveal" id="modal_ajouter_ouvrage" data-reveal>
  
  <div class="row">
  <div class="columns medium-12">
  <h5>Ajout d'un ouvrage</h5></div>
   <div class="columns medium-6">
  		  
  		<input type="text" name="titre_ouvrage" class="custom_input"
  		 placeholder="Titre de l'ouvrage"/>
  		<input type="text" name="isbn" class="custom_input"  
  		 placeholder="ISBN" />
  		 <input type="text" name="edition" class="custom_input" 
  		 placeholder="Editions" />

  		
  	
        <select id="langue" name="langue" class="custom_input">                     
          <option value="Francais">Francais</option>
          <option value="Anglais" >Anglais</option>
          <option value="Creole" >Cr&eacuteole</option>

        </select>

        
        <select id="categorie" name="categorie" class="custom_input">                     
          <option value="roman">Romans</option>
          <option value="historique" >Historique</option>
          <option value="scientifique" >Scientifique</option>
          <option value="poetique" >Po&eacutetique</option>
          <option value="autres" >Autres</option>

        </select>

  

      
<input type="number" name="pages" class="custom_input"
 placeholder="Pages" maxlength="5" size="5" />
   
  </div>
<div class="columns medium-6">
<textarea  style="width:100%;" >  


</textarea>
</div>



  



  	  <div class="columns medium-12" ">
  	<!--   <hr/> -->
        <input type="submit" name="ajout_ouvrage" class="fill_button" value="Ajouter"/>
</div>

<button class="close-button" data-close aria-label="Close reveal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
  </div>
  </div>
  </div>
  </div>
  
</div>








</div></div>

