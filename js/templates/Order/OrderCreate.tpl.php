	<header>
		<h3 class="alert alert-primary" role="alert">
			Bon de Commande de Votre Nouvelle Voiture !
		</h3>
	</header>
	<div class="alert alert-danger" role="alert">Les champs en rouge sont obligatoires !</div>
	</header>
	<form id="order_<?= $action ?>" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
<?php

// Order Form 
require 'Order.tpl.php';

// Form action buttons
?>
	<!--  Form action buttons - Begin -->
	<div>
	<input id="create" name="create" class="btn btn-primary" type="submit" value="Valider" />
	<input id="persist" name="persist" class="btn btn-success" type="submit" value="Enregistrer" />
	</div>
	<!--  Form action buttons - End -->
