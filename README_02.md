# MVC-Core version 02
![Logo UCA - IUT|](images/Logo_IUT-icon.png)
## Introduction
Nous allons utiliser à partir de maintenant le logiciel gestionnaire de dépendances écrit en PHP **Composer**.
Celui-ci va nous permettre de :
* déclarer et d'installer les bibliothèques dont votre projet principal a besoin,
* gérer les dépendances desdites bibliothèques,
* mettre à jours lesdites bibliothèques,
* de bénéficier d'une solution d'auto-chargement des différentes classes du projet : plus de **include_once** ou de **require_once** à gérer.

[Composer](https://getcomposer.org/)

```
Installation de « Composer » (il est nécessaire d'avoir déjaà installé PHP) :

$ # macOS
$ brew install composer
$ # Linux
$ apt-get install composer
$ aptitude install composer
```
```
$ # Version 01 => 02
$ rsync	-auv mvc-core_01/ mvc-core_02/
$ cd mvc-core_02/
$ composer -n init \
	--name "jmbruneau/mvc-core" \
	--description "Basic MVC PHP Framework" \
	--author "Jean-Michel BRUNEAU <jean-michel@netspace.mc>" \
	--type "project" \
	--license "GPL"

$ cat composer.json
{
    "name": "jmbruneau/mvc-core",
    "description": "Basic MVC PHP Framework",
    "type": "project",
    "license": "GPL",
    "authors": [
        {
            "name": "Jean-Michel BRUNEAU",
            "email": "jean-michel@netspace.mc"
        }
    ],
    "require": {}
}
```
## Installation des dépendances :

Recherche d'une bibliothèque :

```
$ composer search composer/
```

### L'« autoloader »
```
$ composer require composer/composer
$ ls vendor/
autoload.php  bin  composer  justinrainbow  psr  react  seld  symfony
```
### Configuration de l'« autoloader » de type « classmap <br />(c.f. documentation de Composer)
```
$ # Edition de composer.json et ajouts des dossiers contenant nos différentes classes
$ nano composer.json
	"require" : {},
	"autoload" : {
		"classmap": [
			"controllers",
			"dao",
			"data",
			"etc",
			"models",
			"views"
		]
	}
$ composer dump-autoload -o
```
### Inclusion de **vendor/autoload.php** dans **index.php**
```
require __DIR__ . '/vendor/autoload.php';
```
> Il est ensuite nécessaire de mettre en place les différents **espaces de nom** dans l'ensemble des fichiers de notre projet.
> L'espace de nom du projet est ici « mvcCore »
> Il faut ensuite supprimer l'ensemble des include, include_once, require, requice_once présent dans les scripts.
> Enfin, il faut vérifier que tout fonctionne correctement ;)

### Framework HTML, CSS & Javascript « Bootstrap »
```
$ # Get bootstrap
$ composer search bootstrap
$ composer require twbs/bootstrap
$ # See css and js files
$ ls vendor/twbs/bootstrap/dist/js/
$ ls vendor/twbs/bootstrap/dist/css/
$ # Make the ad-hoc links (development version)
$ cd css
$ ln -s ../vendor/twbs/bootstrap/dist/css/bootstrap.css bootstrap.css
$ # Optional : for debuging purpose
$ ln -s ../vendor/twbs/bootstrap/dist/css/bootstrap.css.map bootstrap.css.map
$ cd ../js
$ ln -s ../vendor/twbs/bootstrap/dist/css/bootstrap.js bootstrap.js
$ # Optional : for debuging purpose
$ ln -s ../vendor/twbs/bootstrap/dist/css/bootstrap.js.map bootstrap.js.map
```
> Il est ensuite nécessaire d'intégrer « bootstrap.css » et « bootstrap.js » au niveau de notre template…

[Bootstrap documentation](https://getbootstrap.com/docs/4.5/components/forms/)
### Installation de « jQuery »
[jQuery download](https://jquery.com/download/)

```
$ cd js
$ # Download jquery library (development version)
$ wget https://code.jquery.com/jquery-3.5.1.js
$ # Download jquery library (production version)
$ wget https://code.jquery.com/jquery-3.5.1.min.js
$ # Make the ad-hoc link (development version)
$ ln -s jquery-3.5.1.js jquery.js
$ # Make the ad-hoc link (production version)
$ # ln -s jquery-3.5.1.min.js jquery.js
```
## Améliorations et modifications (c.f. version 01)

### Model.php : abstract class, abstract method(s), factorisation(s)

>
>
>

### Controller.php : bstract class, abstract method(s), factorisation(s)

>
>
>

### View.php : bstract class, abstract method(s), factorisation(s)

>
>
>

