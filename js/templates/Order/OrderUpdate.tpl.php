	<header>
		<h3 class="alert alert-warning" role="alert">
			Mise à Jour de la Commande N° <?= $data['id'] ?>
		</h3>
		<div class="alert alert-danger" role="alert">Les champs en rouge sont obligatoires !</div>
	</header>
	<form id="order_<?= $action ?>" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
<?php

// Order Form 
require 'Order.tpl.php';

?>
	<!--  Form action buttons - Begin -->
	<div>
		<input id="update" name="update" class="btn btn-primary" type="submit" value="Mettre à jour" />
	</div>
	<!--  Form action buttons - End -->
