<?php

// Chargement des autres programmes PHP dont on dépend.
require_once 'lib/database.php';
require_once 'models/cocktail.php';

connexionMySQL();

$id=$_GET['id'];

$result = getOneCocktailById(($id));

if(is_file('www/images/cocktails/'.$result['urlPhoto'])){
    //suppression de la photo sur le server
unlink('www/images/cocktails/'.$result['urlPhoto']);
}

//suppression du cocktail en bdd
deleteCocktail($id);


header("Location:back_office.php");