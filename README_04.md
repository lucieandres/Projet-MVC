# MVC-Core version 04
![Logo UCA - IUT|](images/Logo_IUT-icon.png)
## Introduction
```
$ rsync -auv mvc-core_03/ mvc-core_04/
$ cd mvc-core_04/
$ git commit -a -m 'version 04'
```
## PHP

* Elimination des balises de fermeture de PHP "?>" pour éviter des potentiels saut de ligne avant le *<!DOCTYPE html>*
* Ajout d'un fichier .htaccess afin de rediriger toute URL vers le point d'entré unique « index.php » (sécurité renforcée).
* Nom de la session personnalisée : Config::SESSION_NAME = 'MVCCORE'.

## Ajout de fonctionnalités

* dossier admin/ pour une partie administration (modifications ad-hoc .htaccess)
* début de mise en place de commentaires conforme à PHPdoc :
    * https://github.com/phpDocumentor/fig-standards/blob/master/proposed/phpdoc.md
    * https://manual.phpdoc.org/HTMLSmartyConverter/HandS/phpDocumentor/tutorial_tags.pkg.html(e.g. la classe mvcCore\Helpers\Url)

## Ajout des classes liées au différentes actions pour le modèle « Order » intégrées dans le contrôleur OrderControleur.php

* View :
    * OrderReadView.php
    * OrderUpdateView.php
    * OrderDeleteView.php
    * factorisation du code avec la définition d'un *trait* **OrderView.php**
* Template :
    * OrderRead.tpl.php
    * OrderUpdate.tpl.php
    * OrderDelete.tpl.php

## Chiffrement des certaines données pour être conforme à la législation : Commission Nationale de l'Informatique et des Libertés (CNIL) et au Règlement Général sur la Protection des Données (RGPD).

Mise en place d'une classe de chiffrement et déchiffrement : \Helpers\Crypt :
* Chiffrement des données avant leurs persistances en base de données.
* Déchifrement des données après leurs lectures en base de données.
