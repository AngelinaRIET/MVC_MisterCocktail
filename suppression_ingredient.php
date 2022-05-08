<?php
    require_once './lib/database.php';
    require_once './models/cocktail.php';

    //connexion a la bdd
    connexionMySQL();

    //recuperation de l'id dans l'url
    $id = $_GET['id'];

    //suppression du cocktail en bdd
    suppressionIngredient($id);

    //redirection
    header('Location:backoffice_ingredient.php');