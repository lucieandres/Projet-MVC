		<hr />
		<h2>Rechercher</h2>
		<hr />
	
	<header>
	</header>
	<ul class="list-group">
	<?php 
	
	global $userList;

	foreach($userList as $user) {
		?>
		<li class="list-group-item"><?= $user->getFirstname() ?> <?= $user->getLastname() ?> <a class="float-right" href="?model=user&action=profil&id=<?= $user->getId() ?>">Voir le profil</a></li>
		<?php
	}
	
	?>
	</ul>
