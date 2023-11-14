	<header>
		<h3 class="alert alert-success" role="alert">
			Bon de Commande N° <?= $data['id'] ?>
		</h3>
	</header>
	<form id="order_<?= $action ?>" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
<?php

// Order Form 
require 'Order.tpl.php';

?>
	<!--  Form action buttons - Begin -->
	<div>
		<input id="update" name="update" class="btn btn-primary" type="submit" value="Mettre à jour" />
		<input id="delete" name="delete" class="btn btn-danger" type="submit" value="Supprimer" />
	</div>
	<!--  Form action buttons - End -->