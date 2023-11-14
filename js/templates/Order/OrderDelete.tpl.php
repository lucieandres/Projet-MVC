	<header>
		<h3 class="alert alert-danger" role="alert">
			Suppression du Bon de Commande N° <?= $data['id'] ?>
		</h3>
	</header>
	<form id="order_<?= $action ?>" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
<?php

// Order Form 
require 'Order.tpl.php';

?>
	<!--  Form action buttons - Begin -->
	<div>
		<input id="delete" name="delete" class="btn btn-danger" type="submit" value="Supprimer" />
		<input id="create" name="create" class="btn btn-primary" type="submit" value="Nouveau" />
	</div>
	<!--  Form action buttons - End -->
	