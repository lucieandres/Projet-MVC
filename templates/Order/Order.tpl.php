<?php
namespace mvcCore\Views\Templates;

use mvcCore\Data\Cars;

?>
<fieldset class="form-group">
		<legend>Identifiants : </legend>
		<label for="email">Adresse email :</label><input id="email" name="email" class="form-control" type="email" required="required" value="<?= $data['email'] ?>" />
		<label for="mdp">Mot de passe :</label><input id="mdp" name="mdp" class="form-control" type="text" required="required" value="<?= $data['mdp'] ?>" />
	</fieldset>
	<fieldset class="form-group">
		<legend>Informations personnelles : </legend>
		<label for="firstname">Prénom:</label><input id="firstname" name="firstname" class="form-control" type="text" required="required" value="<?= $data['firstname'] ?>" /> 
		<label for="lastname">Nom :</label><input id="lastname" name="lastname" class="form-control" type="text" required="required" value="<?= $data['lastname'] ?>" />
		<label for="birthdate">Date de naissance :</label><input id="birthdate" name="birthdate" class="form-control" type="date" required="required" value="<?= $data['birthdate'] ?>" />
		<label for="adresse">Adresse :</label><input id="adresse" name="adresse" class="form-control" type="text" required="required" value="<?= $data['adresse'] ?>" />
		<label for="telephone">Numéro de téléphone :</label><input id="telephone" name="telephone" class="form-control" type="text" required="required" value="<?= $data['telephone'] ?>" />
		<label for="emailsecours">Email de secours :	(pour pouvoir récupérer votre compte si problème)</label><input id="emailsecours" name="emailsecours" class="form-control" type="email" required="required" value="<?= $data['emailsecours'] ?>" />
	</fieldset>

	
