# MVC-Core version 03
![Logo UCA - IUT|](images/Logo_IUT-icon.png)
## Introduction
```
$ rsync -auv mvc-core_02/ mvc-core_03/
$ cd mvc-core_03/
$ git commit -a -m 'version 03'
```
## Améliorations et optimisations (c.f. version 02)

### Création d'un dossier « helpers/ » pour y placer nos classes « utilitaires »
* Prise en compte de ce dossier dans la configuration de l'autoloader

```
	"autoload" : {
		"classmap" : [
			"controllers",
			"dao",
			"data",
			"etc",
			"helpers",
			"models",
			"views"]
	}
```
* Mise en place d'une classe « Url » permettant de manipuler les URLs avec comme espace de nom « mvcCore\Helpers ».
Ne pas oublier d'effectuer :

```
$ composer dump-autoload -o
ou
$ composer update
```
### data/Cars.php
* Erratum: brend => brand (marque) !

### models/OrderModel.php
* Erratum: brend => brand (marque) !

### views/templates/OrderCreate.tpl.php
* Erratum: brend => brand (marque) !

### Controller.php
* Mise en place progressive des méthodes abstraites relatives aux différentes opérations du CRUD : create(), read(), update() et delete().
* Définition d'une méthode abstraite « imput() » pour capter et assigner les différentes proprétés d'un modèle.
* Intégration d'une méthode display() pour l'affichage du modèle dans un template donné.
* Intégration d'une méthode redirect() pour effectuer des redirections HTTP.
* Intégration d'une méthode persit() pour effectuer une persistance des données du modèle dans la base de données.
* Gestion des erreurs (try catch throw)…

### controllers/OrderController.php
* Déplacement des propriétés spécifiques à la vue dans celle-ci, soit ici dans la classe « OrderCreateView.php ».
* Définition de la méthode « imput() » rélative au modèle « Order ».
* Mise en oeuvre d'un méthode privée pour le calcul du prix total : _total_price().
* Intégration de la méthode read().

### View.php
* Création d'un sous-dossier par Modèle dans le dossier « views/ », soit ici du dossier « Order/ »
* Actualiser alors l'autoloader avec la commande « composer update »
* Définition d'une méthode abstraite setProperties()

### dao/DAO.php
Intégration des méthodes :
* create() (à la place de persit() dans la version 02),
* read(),
* update(),
* et delete().
* Gestion des erreurs (try catch throw)…

### etc/Config.php
* Ajout de paramètres par défaut pour l'action et le modèle
* Syntaxe HTML versus XHMTL pour les *required*, *selected* et *checked*

### Porte d'entrée « index.php »

* Définition d'un variable globale $GLOBALS['request'] avec les paramètres via *index.php*
* Gestion des erreurs (try catch)
* Commentaires ;)

