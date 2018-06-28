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

<table>
	<th>Nom complet</th>
	<th>Pseudo</th>
	<th>Titre</th>
	<th>Date naissance</th>
	<th>Email</th>
	<th>Status</th>
	<th>Photo</th>

	<tr>
		<td>
			<?php //echo $nom_prenom; ?>
		</td>
		<td>
			<?php // echo $pseudo; ?>
		</td>
		<td>
			<?php // echo $titre; ?>
		</td>
		<td>
			<?php //echo $sexe; ?>
		</td>
		<td>
			<?php //echo $date_naissance; ?>
		</td>
		<td>
			<?php //echo $email; ?>
		</td>
		<td>
			<?php //echo $status; ?>
		</td>
		<td>
			<div class="cell medium-12 ">
              <?php if(empty($_SESSION['photo'] )){ ?>
                <img src="<?php echo base_url('assets/avatar/avatar.png'); ?>" style=" width:50px; height:50px" />
              <?php } else {?>
                 <img src="<?php echo base_url('assets/avatar/'.$_SESSION['photo']); ?>" style=" width:50px; height:50px" />
              <?php } ?>
            </div>
		</td>
	</tr>
</table>

<?php if($fetch) { ?>

	<?php foreach ($fetch as $key => $v ) :?> <pre>  <?php // var_dump($v); ?> </pre>
		<?php if (($v->type) === 'EVENEMENT') {?>
			<?php $req = "SELECT * FROM evenement WHERE idevenement = $v->idmembre";
				$sql = $this->db->query($req)->result();
				foreach ($sql as $key => $u) {
					echo "Titre : ".$u->titre. "<br />";
				}
			//	var_dump($sql);
			?>		
		<?php }  ?>
		<?php if (($v->type) === 'OUVRAGE') {?>
			<?php $req = "SELECT * FROM ouvrage WHERE idouvrage = $v->idmembre";
				$sql = $this->db->query($req)->result();
				foreach ($sql as $key => $u) {
					echo "Titre : ".$u->titre. "<br />";
				}
				// var_dump($sql);
			?>		
		<?php }  ?>
		<?php if (($v->type) === 'MEMBRE') {?>
			<?php $req = "SELECT * FROM membre WHERE idmembre = $v->idmembre";
				$sql = $this->db->query($req)->result();
				foreach ($sql as $key => $u) {
					echo "Pseudo : ".$u->pseudo. "<br />";
				}
				// var_dump($sql);
			?>		
		<?php }  ?>


	<?php endforeach ?>
<?php } else {
 echo "Aucun resultat trouver";;
} ?>