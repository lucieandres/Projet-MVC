<?php
namespace mvcCore\Views\Templates;

use mvcCore\Data\Cars;

?>
	<fieldset class="form-group">
		<legend>Informations personnelles : </legend>
		<label for="email">Email :</label><inputid="email" name="email" class="form-control" type="email" required="required" value="<?= $data['email'] ?>" />
		<label for="mdp">Pseudo :</label><input id="mdp" name="mdp" class="form-control" type="text" required="required" value="<?= $data['mdp'] ?>" />
		<label for="lastname">Nom :</label><input id="lastname" name="lastname" class="form-control" type="text" required="required" value="<?= $data['lastname'] ?>" /> 
		<label for="firstname">Prénom:</label><input id="firstname" name="firstname" class="form-control" type="text" required="required" value="<?= $data['firstname'] ?>" /> 
	</fieldset>
	<!--  Brand choice -->
	<fieldset class="form-group">
		<legend>Marque & Modèle : </legend>
		<select id="brand" name="brand" class="form-control auto_submit" required="required">
			<option value="">Marque ?</option>
			<?php
			foreach ( Cars::$brands as $brand => $models) {
				if ( $brand == $data['brand']) {
					echo "<option value=\"$brand\" selected>$brand</option>";
				} else {
					echo "<option value=\"$brand\">$brand</option>";
				}
			}
			?>
		</select>
		<!-- Model choice -->
		<select id="model" name="model" class="form-control auto_submit" required="required">
			<option value="">Modèle ?</option>
			<?php
			if ( isset( $data['brand'])) {
				foreach ( Cars::$brands[$data['brand']] as $model => $prices) {
					if ( $model == $data['model']) {
						echo "<option value=\"$model\" selected>$model</option>";
					} else {
						echo "<option value=\"$model\">$model</option>";
					}
				}
			}
			?>
		</select>
		<!-- Model price -->
		<label for="model_price">Valeur (€) :</label><input id="model_price" type="number" name="model_price" class="form-control" readonly="readonly" value="<?= $data['model_price'] ?>" />
	</fieldset>
	<!-- Gearbox -->
	<fieldset>
		<legend>Boite de vitesse : </legend>
		<div class="form-check">
			<input type="radio" id="gearbox_manual" name="gearbox" class="form-check-input auto_submit" value="manual" <?= $data['checked_gearboxes']['manual'] ?> /> <label class="form-check-label"
				for="gearbox_manual"
			>Manuelle</label>
		</div>
		<div class="form-check">
			<input type="radio" id="gearbox_robotic" name="gearbox" class="form-check-input auto_submit" value="robotic" <?= $data['checked_gearboxes']['robotic'] ?> /> <label class="form-check-label"
				for="gearbox_robotic"
			>Robotisée (1000€)</label>
		</div>
		<div class="form-check">
			<input type="radio" id="gearbox_automatic" name="gearbox" class="form-check-input auto_submit" value="automatic" <?= $data['checked_gearboxes']['automatic'] ?> /> <label class="form-check-label"
				for="gearbox_automatic"
			>Automatique (1500€)</label>
		</div>
		<!--  Gearbox price -->
		<label for="gearbox_price">Valeur (€) :</label><input id="gearbox_price" class="form-control auto_submit" type="number" readonly="readonly" value="<?= $data['gearbox_price'] ?>" />
	</fieldset>
	<!-- Color -->
	<fieldset>
		<legend>Couleur : </legend>
		<div class="form-check">
			<input type="radio" id="color_standard" name="color" class="form-check-input auto_submit" value="standard" <?= $data['checked_colors']['standard'] ?> /> <label class="form-check-label"
				for="color_standard"
			>Standard</label>
		</div>
		<div class="form-check">
			<input type="radio" id="color_metallic" name="color" class="form-check-input auto_submit" value="metallic" <?= $data['checked_colors']['metallic'] ?> /> <label class="form-check-label"
				for="color_metallic"
			>Métalisé (500€)</label>
		</div>
		<div class="form-check">
			<input type="radio" id="color_nacreous" name="color" class="form-check-input auto_submit" value="nacreous" <?= $data['checked_colors']['nacreous'] ?> /> <label class="form-check-label"
				for="color_nacreous"
			>Nacrée (750€)</label>
		</div>
		<!--  Color price -->
		<label for="color_price">Valeur (€) :</label> <input id="color_price" class="form-control auto_submit" type="number" readonly="readonly" value="<?= $data['color_price'] ?>" />
	</fieldset>
	<!-- Options -->
	<fieldset>
		<legend>Options : </legend>
		<div class="form-check">
			<label class="form-check-label" for="option_reversing_radar"> <input type="checkbox" id="option_reversing_radar" name="options[reversing_radar]" class="form-check-input auto_submit" value="reversing_radar"
				<?= $data['checked_options']['reversing_radar'] ?>
			/>Radar de recul (300€)
			</label>
		</div>
		<div class="form-check">
			<label class="form-check-label" for="option_xenon_lighthouse"><input type="checkbox" id="option_xenon_lighthouse" name="options[xenon_lighthouse]" class="form-check-input auto_submit"
				value="xenon_lighthouse" <?= $data['checked_options']['xenon_lighthouse'] ?>
			/>Phares au xénon (750€)</label> 
		</div>
		<div class="form-check">
			<label class="form-check-label" for="option_speed_regulator"><input type="checkbox" id="option_speed_regulator" name="options[speed_regulator]" class="form-check-input auto_submit"
				value="speed_regulator" <?= $data['checked_options']['speed_regulator'] ?>
			/>Régulateur de vitesse (300€)</label> 
		</div>
		<div class="form-check">
			<label class="form-check-label" for="option_rain_sensor"> <input type="checkbox" id="option_rain_sensor" name="options[rain_sensor]" class="form-check-input auto_submit" value="rain_sensor"
				<?= $data['checked_options']['rain_sensor'] ?>
			/>Capteur de pluie (250€)</label>
		</div>
		<div class="form-check">
			<label class="form-check-label" for="option_air_conditioner"><input type="checkbox" id="option_air_conditioner" name="options[air_conditioner]" class="form-check-input auto_submit"
				value="air_conditioner" <?= $data['checked_options']['air_conditioner'] ?>
			/>Climatisation (1000€)</label> 
		</div>
		<!-- Options price -->
		<label for="options_price">Total des options (€) :</label> <input id="options_price" class="form-control" type="number" readonly="readonly" value="<?= $data['options_price'] ?>" />
	</fieldset>
	<fieldset>
		<legend>Reprise de l'ancien véhicule (€) :</legend>
		<label for="return_price"> <input id="return_price" name="return_price" class="form-control auto_submit" type="number" required="required" value="<?= $data['return_price'] ?>" min="0" max="3000" />
		</label>
	</fieldset>
	<fieldset>
		<legend>Prix total (€) :</legend>
		<label for="total_price"> <input id="total_price" name="total_price" class="form-control" type="number" readonly="readonly" value="<?= $data['total_price'] ?>" />
		</label>
	</fieldset>
