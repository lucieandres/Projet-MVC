# MVC-Core version 01
![Logo UCA - IUT|](images/Logo_IUT-icon.png)

## Routeur : index.php
Point d'entrée unique !
- controles plus simple.
- sécurité renforcée.

### Améliorations :
- session_start();
- valider les paramètres "model" et "action"
- gérer les erreurs
- choix d'un modèle et d'une action par défaut…

## Model : Model.php

### Améliorations :
- classe abstraite
- méthodes abstraite
- factorisation

## Controller : Controller.php

### Améliorations :
- factorisation
- méthodes abstraite input()

## Controller : OrderController.php
- déplacement des propriétés spécifiques liées à la vue dans celle-ci.
- ajout de la méthode imput() pour traiter spécifiquement les données en entrée.
- ajout d'une méthode _total_price() pour calculer le prix total d'achat.

## View : View.php

### Améliorations :
- sous-dossiers en fonction du Model
- sous-dossiers dans template en fonction du Model

## Base de Données :
- Client « lourd » multi-plateformes : pgAdmin 4
- URL : https://www.pgadmin.org
- Documentation URL : https://www.pgadmin.org/docs/pgadmin4/4.27/index.html
- Download URL : https://www.pgadmin.org/download/

