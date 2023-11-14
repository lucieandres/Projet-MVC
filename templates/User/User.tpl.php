<?php
namespace mvcCore\Views\Templates;

use mvcCore\Data\Cars;

?>

<fieldset class="form-group">
		<legend>Identifiants : </legend>
		<label for="email">Adresse email :</label><input type="email" id="email" name="email" class="form-control" type="email" required="required" value="<?= $data['email'] ?>" />
		<label for="password">Mot de passe :</label><input type="password" id="password" name="password" class="form-control" type="text" required="required" value="<?= $data['password'] ?>" />
	</fieldset>
	<fieldset class="form-group">
		<legend>Informations personnelles : </legend>
		<label for="firstname">Prénom:</label><input id="firstname" name="firstname" class="form-control" type="text" required="required" value="<?= $data['firstname'] ?>" /> 
		<label for="lastname">Nom :</label><input id="lastname" name="lastname" class="form-control" type="text" required="required" value="<?= $data['lastname'] ?>" />
		<label for="birthdate">Date de naissance :</label><input id="birthdate" name="birthdate" class="form-control" type="date" required="required" value="<?= $data['birthdate'] ?>" />
		<label for="adresse">Adresse :</label><input id="address" name="address" class="form-control" type="text" required="required" value="<?= $data['address'] ?>" />
		<label for="telephone">Numéro de téléphone :</label><input id="phonenumber" name="phonenumber" class="form-control" type="text" required="required" value="<?= $data['phonenumber'] ?>" />
		<label for="safetyemail">Email de secours :	(pour pouvoir récupérer votre compte si problème)</label><input type="email" id="safetyemail" name="safetyemail" class="form-control" type="email" required="required" value="<?= $data['safetyemail'] ?>" />
	</fieldset>

	
