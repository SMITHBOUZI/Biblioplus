<h1> Notification </h1>

<?php if ($notifications) : ?> <?php // var_dump($notifications); ?>
	<?php foreach ($notifications as $key ) :?>
  		<li><a href="#">Notification :</a> <?php echo " ".$key->nbr_notify; ?> </li>
  	<?php endforeach ?>
<?php endif ?>
