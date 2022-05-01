<?php

// Chargement des autres programmes PHP dont on dépend.
require_once 'lib/database.php';
require_once 'models/cocktail.php';

connexionMySQL();

// Récupération du cocktail stocké en base de données
$result = getOneCocktailById($_GET['id']);

// Chargement du template
include 'templates/details_cocktail.phtml';