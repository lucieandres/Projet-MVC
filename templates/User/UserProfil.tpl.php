<?php
	global $user;
	global $_modal;
?>

		<hr />
		<h2>Profil de <?= $user->getFirstname()." ".$user->getLastname() ?></h2>
		<hr />
		<?php 
		global $error;
		global $success;
		global $infos;
		global $friend;

		?>
		<div class="bg-white text-dark border border-info rounded p-3 m-1 d-flex row">
			<div class="col-auto">
				<?php
				if($user->getPhoto() != null) 
					echo '<img src="'.$user->getPhoto().'" width="90" height="90" alt="Photo de profil" class="rounded-circle" />';
				
				else
					echo '<img src="images/profil/default.png" width="90" height="90" alt="Photo de profil" class="rounded-circle" />';
				?>
			</div>
			<div class="col">
				Adresse: <span class="badge badge-pill badge-secondary"><?= $user->getAddress() ?></span><br>
				Numéro de téléphone: <span class="badge badge-pill badge-secondary"><?= $user->getPhonenumber() ?></span><br>
				Date de naissance: <span class="badge badge-pill badge-secondary"><?= $user->getBirthdate() ?></span><br>
			</div>
			<div>
			<?php 
			if($user->getEmail() != $_modal->getEmail()) {
				?>
				<form id="info_<?= $action ?>" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
					<?php
					if($friend >= 0) {
						?>
						<input name="id" class="d-none" value="<?= $friend ?>">
						<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteFriend">
							Supprimer de la liste d'amis
						</button>

						<div class="modal fade" id="deleteFriend" tabindex="-1" aria-labelledby="deleteFriend" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									Es-tu sûr de vouloir supprimer <?= $user->getFirstname()." ".$user->getLastname() ?> de la liste d'amis ?
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
									<input id="deleteFriend" name="deleteFriend" class="btn btn-danger" type="submit" value="Supprimer <?= $user->getFirstname()." ".$user->getLastname() ?>" />
								</div>
								</div>
							</div>
						</div>
						<?php
					} else {
						?>
						<input name="id" class="d-none" value="<?= $user->getId() ?>">
						<input id="invit" name="invit" class="btn btn-primary" type="submit" value="Envoyer une demande d'ami(e)" />
						<?php
					}
					?>
				</form><br>
				<?php
			}
			?>
			</div>
		</div>
		<br>
	<header>
	</header>
	<?php

		if(isset($error)) 
			echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';

		if(isset($success)) 
			echo '<div class="alert alert-success" role="alert">'.$success.'</div>';

			?>
						<form id="info_<?= $action ?>" method="GET" action="<?= $_SERVER['REQUEST_URI'] ?>" class="bg-white text-dark border border-secondary rounded p-3 m-1">
						<input type="hidden" name="page" value="<?= $_GET['page'] ?>" />
							<input name="model" class="d-none" value="user">
							<input name="action" class="d-none" value="profil">
							<input name="id" class="d-none" value="<?= $user->getId() ?>">

							<div class="form-group">
								<label for="date">Chercher par date</label>
								<input type="month" class="form-control" id="date" name="date" required="required" value="<?= isset($_GET['date']) ? $_GET['date'] : '' ?>">
							</div>

							<button type="submit" class="btn btn-primary">Chercher</button>
		
						</form>
					<br>
					<?php

				if(count($infos) == 0)
					echo '<i>Aucune information a été publiés.</i>';		

				foreach($infos as $data) {
					$info = $data[0];
					$like = $data[1];
					$dislike = $data[2];
					?>
					<div class="card">
						<?php 
						if($info->getPhotoTitle() != null)
							echo '<img src="'.$info->getPhotoTitle().'" class="card-img-top" alt="'.$info->getTitle().'">';
						?>

						<div class="card-body">
								<?php 
									if(!$info->getPublic())
										echo '<span class="badge bg-success float-right text-white">Amis</span>';
									else
										echo '<span class="badge bg-info float-right text-white">Publique</span>';
								?>
								<h5 class="card-title"><?= $info->getTitle() ?></h5>
								<p class="card-text"><?= str_replace("\n", "<br>", $info->getContent()) ?></p>

								<form id="info_<?= $action ?>" method="post" action="<?= $_SERVER['REQUEST_URI'] ?>">
									<div class="btn-group btn-group-toggle" data-toggle="buttons">
										<label class="btn btn-outline-success btn-sm">
											<input type="radio" name="like" value="like" id="option1_<?= $info->getId() ?>" data-toggle="collapse" href="#checked_<?= $info->getId() ?>"> J'aime
											<span class="badge badge-success"><?= count($like) ?></span>
										</label>
										<label class="btn btn-outline-danger btn-sm">
											<input type="radio" name="like" value="dislike" id="option2_<?= $info->getId() ?>" data-toggle="collapse" href="#checked_<?= $info->getId() ?>"> Je n'aime pas
											<span class="badge badge-danger"><?= count($dislike) ?></span>
										</label>
									</div>

									<?php
									if(isset($_SESSION['session']) && strlen($_modal->getEmail()) != 0) {
									?>
									<div class="collapse" id="checked_<?= $info->getId() ?>">
										<div class="form-group">
											<label for="comment">Commentaire</label>
											<textarea class="form-control" id="comment" rows="3" name="comment"></textarea>
										</div>
										<input name="id" class="d-none" value="<?= $info->getId() ?>">
										<button id="opinion" name="opinion" type="submit" class="btn btn-primary">Envoyer</button>
										<div id="opinionData_<?= $info->getId() ?>"></div>
									</div>
									<?php
									}
									?>
								</form>
								<?php
								if(isset($_SESSION['session']) && strlen($_modal->getEmail()) != 0) {
								?>
								<script>
									var div_<?= $info->getId() ?> = document.getElementById('opinionData_<?= $info->getId() ?>');

									let like_bt_<?= $info->getId() ?> = document.getElementById('option1_<?= $info->getId() ?>');
									let dislike_bt_<?= $info->getId() ?> = document.getElementById('option2_<?= $info->getId() ?>');

									like_bt_<?= $info->getId() ?>.addEventListener('change', function() {
										div_<?= $info->getId() ?>.innerHTML = `
										<?php
										foreach($like as $data) {
											$opinion = $data[0];
											$from = $data[1];

											?>
											<br>
											<div class="card-body border border-success rounded">
												<h5 class="card-title">
												<?php
													if($from->getPhoto() != null) 
														echo '<img src="'.$from->getPhoto().'" width="30" height="30" alt="Photo de profil" class="rounded-circle" />';
														
													else
														echo '<img src="images/profil/default.png" width="30" height="30" alt="Photo de profil" class="rounded-circle" />';
												?>
												<a href="?model=user&action=profil&id=<?= $from->getId() ?>"><?= $from->getFirstname()." ".$from->getLastname() ?></a>
												</h5>
												<p class="card-text"><?= $opinion->getComment() ?></p>
											</div>
											<?php
										}
										?>
										`;
									});

									dislike_bt_<?= $info->getId() ?>.addEventListener('change', function() {
										div_<?= $info->getId() ?>.innerHTML = `
										<?php
										foreach($dislike as $data) {
											$opinion = $data[0];
											$from = $data[1];

											?>
											<br>
											<div class="card-body border border-danger rounded">
												<h5 class="card-title">
												<?php
													if($from->getPhoto() != null) 
														echo '<img src="'.$from->getPhoto().'" width="30" height="30" alt="Photo de profil" class="rounded-circle" />';
														
													else
														echo '<img src="images/profil/default.png" width="30" height="30" alt="Photo de profil" class="rounded-circle" />';
												?>
												<a href="?model=user&action=profil&id=<?= $from->getId() ?>"><?= $from->getFirstname()." ".$from->getLastname() ?></a>
												</h5>
												<p class="card-text"><?= $opinion->getComment() ?></p>
											</div>
											<?php
										}
										?>
										`;
									});
								</script>
								<?php
								}
								?>
						</div>
					</div><br>
					<?php
				}
				$previous = 0;
				$next = 1;
				$page = 0;

				if(isset($_GET['page'])) {
					$page = (int)$_GET['page'];
					if($page > 1) {
						$previous = $page - 1;
						$next = min($page + 1, ceil($count / 10));
					}
				}

				global $count;

				if($count > 10) {
			?>
					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<li class="page-item">
							<a class="page-link" href="?model=user&action=profil&id=<?= $user->getId() ?>&page=<?= $previous ?><?= isset($_GET['date']) ? "&date=".$_GET['date'] : '' ?>" aria-label="Previous">
								<span aria-hidden="true">&laquo;</span>
							</a>
							</li>
							<?php 

							for($i = 0; $i < ceil($count / 10); $i++) {
								echo '<li class="page-item'.($page == $i ? " active" : "").'"><a class="page-link" href="?model=user&action=profil&id='.$user->getId().'&page='.$i;
								if(isset($_GET['date']))
									echo "&date=".$_GET['date'];
								echo '">'.($i + 1).'</a></li>';
							}
							?>
							<li class="page-item">
							<a class="page-link" href="?model=user&action=profil&id=<?= $user->getId() ?>&page=<?= $next ?><?= isset($_GET['date']) ? "&date=".$_GET['date'] : '' ?>" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
							</a>
							</li>
						</ul>
					</nav>
					<?php
				}
