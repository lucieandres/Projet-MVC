		<hr />
		<h2>INSCRIPTION</h2>
		<hr />
	
	<header>
		<h3 class="alert alert-primary" role="alert">
			Pensez à vérifier vos informations avant de valider
		</h3>
	</header>
	<div class="alert alert-danger" role="alert">Les champs en rouge sont obligatoires !</div>
	<?php 
	global $error;
	if(isset($error)) {
		echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
	}
	?>
	</header>
	<form id="user_<?= $action ?>" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
<?php

// user Form 
require 'User.tpl.php';

// Form action buttons
?>
	<!--  Form action buttons - Begin -->
	<div>
	<input id="create" name="create" class="btn btn-primary" type="submit" value="Valider" />
	<input id="persist" name="persist" class="btn btn-success" type="submit" value="Enregistrer" />
	</div>
	<!--  Form action buttons - End -->
