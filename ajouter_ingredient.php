<?php

    require_once 'lib/database.php';
    require_once 'models/cocktail.php';

    //connexion a la bdd
    connexionMySQL();

    //test de la présence de la variable en POST
    if(
        isset($_POST['nom']) && !empty($_POST['nom'])
    ){

        $nom = $_POST['nom'];

        //appel de la fonction d'ajout en BDD
        ajouterIngredient($nom);

        //redirection
        header("Location:backoffice_ingredient.php");
    }

    //chargement des données pour l'affichage du formulaire
    $listFamille = getListFamille();
    $listIngredients = getAllIngredients();

    //appel du visuel
    include 'templates/ajouter_ingredient.phtml';