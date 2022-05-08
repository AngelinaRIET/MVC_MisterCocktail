<?php

// Chargement des autres programmes PHP dont on dépend.
require_once 'lib/database.php';
require_once 'models/cocktail.php';

//appel de la function pour lancer la connexion a la database
connexionMySQL();

// Récupération de tous les cocktails stockés en base de données
$listIngredient = getAllIngredients();

// Chargement du template
include 'templates/backoffice_ingredient.phtml';