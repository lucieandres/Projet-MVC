		<hr />
		<h2>Mon Compte</h2>
		<hr />
	
	<header>
	</header>
	<?php 
	global $model;

	if(isset($model)) {
		?>
		<div class="bg-white text-dark border border-info rounded p-3 m-1 d-flex row">
			<div class="col-auto">
				<?php
				if($model->getPhoto() != null) 
					echo '<img src="'.$model->getPhoto().'" width="90" height="90" alt="Photo de profil" class="rounded-circle" />';
				
				else
					echo '<img src="images/profil/default.png" width="90" height="90" alt="Photo de profil" class="rounded-circle" />';
				?>
			</div>
			<div class="col">
				Adresse: <span class="badge badge-pill badge-secondary"><?= $model->getAddress() ?></span><br>
				Numéro de téléphone: <span class="badge badge-pill badge-secondary"><?= $model->getPhonenumber() ?></span><br>
				Date de naissance: <span class="badge badge-pill badge-secondary"><?= $model->getBirthdate() ?></span><br>
			</div>
		</div>
		<hr />
		<?php 
			global $error;
			global $info;
			global $infoModel;
			global $infoList;
			global $edit;

			global $inviteList;
			global $friendList;

			if(isset($error)) 
				echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
			
			if(isset($info)) 
				echo '<div class="alert alert-success" role="alert">'.$info.'</div>';

			if(isset($edit)) {
				$infoModel = $edit;
				$error = '.';
			}

			if(count($inviteList)) {
				?>
				<h5>Demandes d'ami(e)s</h5>
				<ul class="list-group">
				<?php
				foreach($inviteList as $data) {
					$friend = $data[0];
					$invit = $data[1];
					?>
					<li class="list-group-item">
						<a href="?model=user&action=profil&id=<?= $friend->getId() ?>"><?= $friend->getFirstname() ?> <?= $friend->getLastname() ?></a>
						<div class="float-right">
							<a href="?model=user&action=account&accept=<?= $invit->getId() ?>">Accepter</a> 
							<a href="?model=user&action=account&decline=<?= $invit->getId() ?>">Refuser</a>
						</div>
					</li>
					<?php
				}
				?>
				</ul>
				<hr />
				<?php
			}
			
		?>
		<h5><?= isset($edit) ? 'Modifier' : 'Ajouter' ?> une information</h5>
		<form id="info_<?= $action ?>" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
			<div class="mb-3">
				<label for="title" class="form-label">Titre</label>
				<input class="form-control" id="title" name="title" required="required" value="<?= isset($error) ? $infoModel->getTitle() : '' ?>">
			</div>
			<div class="mb-3">
				<label for="content" class="form-label">Contenu</label>
				<textarea class="form-control" id="content" rows="3" name="content" required="required"><?= isset($error) ? $infoModel->getContent() : '' ?></textarea>
			</div>

			<div class="form-group form-check">
				<input type="checkbox" class="form-check-input" id="public" name="public" <?= isset($edit) && $edit->getPublic() ? "checked" : "" ?>>
				<label class="form-check-label" for="public">Mettre l'information publique</label>
			</div>

			<div>
			<?php
			if(isset($edit)) {
				?>
				<input name="id" class="d-none" value="<?= $edit->getId() ?>">
				<input id="confirmInformation" name="confirmInformation" class="btn btn-primary" type="submit" value="Modifier" />
				<?php
			} else {
				?>
				<input id="information" name="information" class="btn btn-primary" type="submit" value="Ajouter" />
				<?php
			}
		global $collapseInfo;
			?>
		</form>
		<hr />
		<a class="btn btn-primary" data-toggle="collapse" id="info" href="#informations" role="button" aria-expanded="false" aria-controls="informations">
			Voir les informations publiés
		</a>

		<div class="collapse <?=  $collapseInfo ? 'show' : '' ?>" id="informations">
  			<div class="card card-body">
				<?php
				if(count($infoList) == 0)
					echo '<i>Aucune information a été publiés.</i>';		

				foreach($infoList as $info) {
					?>
					<div class="card">
						<?php 
						if($info->getPhotoTitle() != null)
							echo '<img src="'.$info->getPhotoTitle().'" class="card-img-top" alt="'.$info->getTitle().'">';
						?>

						<div class="card-body">
							<form id="info_<?= $action ?>" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
								<?php 
									if(!$info->getPublic())
										echo '<span class="badge bg-success float-right text-white">Amis</span>';
									else
										echo '<span class="badge bg-info float-right text-white">Publique</span>';
								?>
								<h5 class="card-title"><?= $info->getTitle() ?></h5>
								<p class="card-text"><?= str_replace("\n", "<br>", $info->getContent()) ?></p>

								<input name="id" class="d-none" value="<?= $info->getId() ?>">
			
								<input id="edit" name="edit" class="btn btn-primary" type="submit" value="Modifier" />
								
								<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_<?= $info->getId() ?>">
									Supprimer
								</button>

								<div class="modal fade" id="delete_<?= $info->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										Es-tu sûr de vouloir supprimer l'information "<?= $info->getTitle() ?>" ?
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
										<input id="delete" name="delete" class="btn btn-danger" type="submit" value="Supprimer" />
									</div>
									</div>
								</div>
								</div>
						
							</form>
						</div>
					</div><br>
					<?php
				}
			}
			?>
			</div>
		</div>
		<br><br>
		<a class="btn btn-primary" data-toggle="collapse" href="#friends" role="button" aria-expanded="false" aria-controls="friends">
			Voir la liste de mes amis
		</a>

		<div class="collapse" id="friends">
  			<div class="card card-body">
				<ul class="list-group">
					<?php
					if(count($friendList) == 0)
						echo '<i>La liste est vide.</i>';	

					foreach($friendList as $data) {
						$friend = $data[0];
						$inv = $data[1];
						?>
						<li class="list-group-item">
							<a href="?model=user&action=profil&id=<?= $friend->getId() ?>"><?= $friend->getFirstname() ?> <?= $friend->getLastname() ?></a>
							<div class="float-right">
								<a href="?model=user&action=account&deleteFriend=<?= $inv->getId() ?>">Supprimer</a> 
							</div>
						</li>
						<?php
					}
					?>
				</ul>
			</div>
		</div><br><br>

		<a class="btn btn-primary" data-toggle="collapse" href="#edit" role="button" aria-expanded="false" aria-controls="friends">
			Modifier mes informations personnelles 
		</a>

		<div class="collapse" id="edit">
			<div class="card card-body">
				<form id="info_<?= $action ?>" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>" enctype="multipart/form-data">
					<div class="form-group">
						<label for="exampleInputEmail1">Prénom</label>
						<input class="form-control" id="exampleInputEmail1" value="<?= $model->getFirstname() ?>" name="firstname">

						<label for="exampleInputPassword1">Nom</label>
						<input class="form-control" id="exampleInputPassword1" value="<?= $model->getLastname() ?>" name="lastname">

						<label for="exampleInputPassword1">Email</label>
						<input class="form-control" id="exampleInputPassword1" readonly value="<?= $model->getEmail() ?>">

						<label for="birthdate">Date de naissance :</label>
						<input id="birthdate" name="birthdate" class="form-control" type="date" required="required" value="<?= $model->getBirthdate() ?>" name="birthdate" />

						<label for="adresse">Adresse :</label>
						<input id="address" name="address" class="form-control" type="text" required="required" value="<?= $model->getAddress() ?>" name="address" />
				
						<label for="telephone">Numéro de téléphone :</label>
						<input id="phonenumber" name="phonenumber" class="form-control" type="text" required="required" value="<?= $model->getPhonenumber() ?>" name="phonenumber" />

						<label for="exampleInputPassword1">Email de secours</label>
						<input class="form-control" id="exampleInputPassword1" readonly value="<?= $model->getSafetyemail() ?>">

						<label for="exampleFormControlFile1">Photo de profil:</label>
						<input type="file" class="form-control-file" id="exampleFormControlFile1" name="picture">

						<input name="id" class="d-none" value="<?= $model->getId() ?>">
					</div>
					<button id="update" name="update" type="submit" class="btn btn-primary">Modifier</button>
				</form>
			</div>
		</div>
			