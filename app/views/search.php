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
	<th>sexe</th>
	<th>Date naissance</th>
	<th>Email</th>
	<th>Status</th>
	<th>Photo</th>

	<tr>
		<td>
			<?php echo $nom_prenom; ?>
		</td>
		<td>
			<?php echo $pseudo; ?>
		</td>
		<td>
			<?php echo $sexe; ?>
		</td>
		<td>
			<?php echo $date_naissance; ?>
		</td>
		<td>
			<?php echo $email; ?>
		</td>
		<td>
			<?php echo $status; ?>
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