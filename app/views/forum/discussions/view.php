

<div class="row" id="contenair_contenu_sujet" >
	<div class="columns large-12 medium-12"  >
<div class="columns large-12 medium-12" id="entete">
		<h2>Forum Biblioplus</h2>
</div>

         <div class="columns large-12 medium-12" id="box_sujet_poster">
     <?php if (isset($_SESSION['flash'])): ?>
		<?php foreach ($_SESSION['flash'] as $type => $message):?>
			<div class="alert alert-<?= $type; ?>">
				<?= $message; ?> 						
			</div>
		<?php endforeach ?>
		<?php unset($_SESSION['flash']) ?>
	<?php endif ?>
	    <div class=" columns large-12 medium-12" id="sujet">
	    	<?php foreach ($forums as $rows): ?> <pre><?php var_dump($rows); ?></pre>
		  <h3 id="sujet" style="font-family: Times new roman"> <?php //$rows->sujet ; ?>  </h3>
	    </div>

	    <div class="columns large-12 medium-12" id="categorie">
	    	<h6><?php //echo $contenu_c ; ?> </h6>
	    </div>
	  
	    <div class="columns large-12 medium-12" style="padding: 0px;">

	    	<div class="columns large-1 medium-1" style="padding: 0px; text-align: center; font-style: italic; color: gray;">
	    	<div class="columns large-12 medium-12" >
		    	<?php //if(empty($_SESSION['photo'] )){ ?>
	                <img src="<?php //echo base_url('assets/avatar/avatar.png'); ?>" class="thumbnail" alt="" style="border-radius: 50%" />
	              <?php //} else {?>
	                 <img src="<?php //echo base_url('assets/avatar/'.$_SESSION['photo']); ?>" class="thumbnail" alt="" style="border-radius: 50%" />
	            <?php //} ?>
	    	</div>
	    	<div class="columns large-12 medium-12">
	    	<small><span><?php // echo $pseudo; ?></span></small>	
	    	</div>
	    	</div>

	    	<div class="columns large-11 medium-11" id="contenu_sujet">
	    	<p style="text-align: justify;">
	    		<?php // echo $contenu_s; ?>
	    	<?php endforeach ?>
	    	</p>
	    	</div>

	    	<div class="columns large-12 medium-12">
	    		<input type="button" id="show" value="réagir">
	    	</div>

	    	<script type="text/javascript">
	    		$('#show').click(function() {
	    			// body...
	    			$('#espace_de_reaction').show();

	    			$('#valider').click( function () {
	    				// body...
	    				$('#espace_de_reaction').hide(); 
	    			} )
	    		})
	    	</script>

	    </div>

	</div>
	<div class="columns large-12 medium-12" id="espace_de_reaction">
	
	<?php echo form_open_multipart('forum/comment','class=""');?> 
		<?php // if(isset($id)): ?>
			<input type="hidden" name="id" id="id" value="<?php // echo $id ?>" />	
		<?php // endif; ?>
		<div class="columns large-12 medium-12" >
	     <textarea  rows="6" cols="40" placeholder="" name="tcontenue" class="tcontenue"></textarea>	
			   <script>
				CKEDITOR.replace( 'comment' );
			</script>    
		</div>
	    <div class="columns large-12 medium-12">
	    	<input type="submit" name="poster" value="poster" id="custom_input_post" />
	    </div>
	    <?php echo form_close();  ?>
	 <!--  </form>  -->
			<!-- <input type="submit" class="btn btn-primary" name="comment" value="Comment"> -->
	</div>
	

	<div class="columns large-12 medium-12" id="reaction">
    	<div class="columns large-1 medium-1"style="padding: 0px; text-align: center; font-style: italic; color: gray;">
    	<div class="columns large-12 medium-12" >
    	<img src="https://placehold.it/50x50" class="thumbnail" alt="" style="border-radius: 50%">
    	</div>
    	<?php // $req = $this->forum->comment(); ?>
    	<?php  //if(isset($contenu_m)): ?>
    	<div class="columns large-12 medium-12">
    		<small><span><?php //echo $pseudo_poster; ?></span></small>	
    	</div>
    	</div>
    <div class="columns large-11 medium-11 " style="text-align: justify; padding: 0px; position: relative; top: 10px;"> 
    	<div class="columns large-12 medium-12" style="text-align: right; font-style: italic; color: gray;"><!-- <?= $date_hres_edition; ?> -->12h 30min</div>
        <div class="columns large-12 medium-12">
    	<p><!-- <?= $contenu_m; ?> --> Lol</p>
    	</div>
    <?php // endif ?>
    </div>    
	</div>
	</div>

</div>
</body>
</html>