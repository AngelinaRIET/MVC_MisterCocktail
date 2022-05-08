<?php

    require_once './lib/database.php';
    require_once './models/cocktail.php';

    connexionMySQL();

    if(
        isset($_POST['nom']) && !empty($_POST['nom'])
    ){
        
        $nom = $_POST['nom'];

        //appel de la fonction qui va modifier dans la bdd
        modifierIngredient($_GET['id'], $nom);

        //redirection
        header("Location:backoffice_ingredient.php");
    }

    $result = getOneIngredientById($_GET['id']);


    include './templates/edition_ingredient.phtml';

