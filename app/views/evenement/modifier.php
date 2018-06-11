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
               <!-- <form > --> 
                <?php echo form_open_multipart('event/index','class=""');?> 
                <div class="columns large-6 medium-6" align="center">
                  <div class="col-sm-3 text-center">
                    <img class="avatar" src="<?php echo base_url('assets/img/index.jpeg') ?>">
                    <br><br>
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
                    <input type="radio" name="Activites" id="prix" align="left"> Prix</input>
                  </div>
                  <div class=" columns large-6 medium-6 small-6">
                    <input type="radio" name="Activites" id="gratuit" align="right"> Gratuit</input>
                  </div>
                   </div>
                  <!-- <div class="columns large-12 medium-12" style=" padding: 0px;"> -->
                  <div class=" columns large-4 medium-4 small-4" >
                    <label>Prix</label>
                    <input type="number" name="prix" placeholder="gdes">
                  </div>
                  <div class=" columns large-8 medium-8 small-8">
                    <label>Point de vente</label>
                    <input type="text" name="pointDevente" placeholder="Entrez un Point de vente">
                  </div>
                  <!-- </div>  -->   
                  <input class="fill_button" type="submit" id="addEvent" name="addEvent" value="Ajouter"/> 
                </div>
                </div>

                <?php echo form_close();  ?>
             <!--  </form> -->
              <button class="close-button" data-close aria-label="Close modal" type="button">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          
          </div>

          <!-- Fin modal ajout_evenement -->
