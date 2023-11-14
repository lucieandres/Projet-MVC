<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<meta name="description" content="Car Whorkshop Form Order" />
		<meta name="author" content="Jean-Michel Bruneau" />
		<title>RESEAU SOCIAL</title>
		<!-- bootstrap css -->
		<link href="css/bootstrap.css" rel="stylesheet" />
		<!-- global css go here -->
		<link href="css/index.css" rel="stylesheet" />
		<!-- bootstrap scripts -->
		<script defer="defer" src="js/jquery.js"></script>
		<script defer="defer" src="js/bootstrap.js"></script>
		<!-- global scripts go here -->
	</head>
	<?php global $anchor; ?>
	<body class="bg-light"<?= isset($anchor) ? ' onload="location.href=\'#'.$anchor.'\';"' : '' ?>>
		<!--  Common header -->
		<header>
			<h1>RESEAU SOCIAL</h1>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
				<!-- <a class="navbar-brand" href="#">Barre de navigation</a> -->
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNav">
					<ul class="navbar-nav">
						<!--
						<li class="nav-item"><a class="nav-link" href="../index.html">M314 Project</a></li>
						-->
						<li class="nav-item active"><a class="nav-link" href="index.php">Home</a></li>
						<?php 
						if(empty($_SESSION['session'])) {
							?>
							<li class="nav-item"><a class="nav-link" href="index.php?model=user&action=create">Inscription</a></li>
							<li class="nav-item"><a class="nav-link" href="index.php?model=user&action=login">Connexion</a></li>
							<?php
						} else {
							?>
							<li class="nav-item"><a class="nav-link" href="index.php?model=user&action=account">Mon compte</a></li>
							<li class="nav-item"><a class="nav-link" href="index.php?model=user&action=disconnect">Déconnexion</a></li>
							<?php
						}
						?>
						<li class="nav-item"><a class="nav-link" href="index.php?model=user&action=search">Rechercher</a></li>
						<!-- <li class="nav-item"><a class="nav-link" href="index.php?model=user&action=read&id=1">Display Order</a></li>
						<li class="nav-item"><a class="nav-link" href="index.php?model=user&action=read">Display All Order</a></li>
						<li class="nav-item"><a class="nav-link" href="index.php?model=user&action=update&id=2">Update Order</a></li>
						<li class="nav-item"><a class="nav-link disabled" href="index.php?model=user&action=delete&id=6">Delete Order</a></li> -->
					</ul>
				</div>
			</nav>
		</header>
		<!-- Main div container -->
		<div class="container">