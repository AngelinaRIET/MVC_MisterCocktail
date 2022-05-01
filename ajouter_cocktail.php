<?php

    require_once 'lib/database.php';
    require_once 'models/cocktail.php';

    //connexion à la bdd
    connexionMySQL();

    //bloc permettant d'afficher les erreurs dans la page
    $errorName = "";
    if(isset($_POST['nom']) && empty($_POST['nom'])){
        $errorName =  'Attention vous n\'avez pas remplis le nom';
    }

    $errordescription = "";
    if(isset($_POST['description']) && empty($_POST['description'])){
        $errordescription =  'Attention vous n\'avez pas remplis la description';
    }

    $errorFile = "";

    //on teste si tous les champs du formulaire sont bons alors on fait l'enregistrement en bdd
    if(
        isset($_POST['nom']) && !empty($_POST['nom']) && 
        isset($_POST['description']) && !empty($_POST['description']) && 
        isset($_POST['dateConception']) && !empty($_POST['dateConception']) && 
        isset($_POST['prixMoyen']) && !empty($_POST['prixMoyen']) && 
        isset($_POST['idFamille']) &&!empty($_POST['idFamille'])
    ){

        //on teste la taille du fichier pour voir s'il est inferieur a 2Mo
        if($_FILES['urlPhoto']['size'] < 2000000){

            //on crée un tableau pour les type de fichier que l'on veux autoriser
            $tabTypeAuthorise = ['image/png', 'image/jpeg'];

            //on teste si le type du fichier est présent dans le tableau des types autorisés
            if(in_array($_FILES['urlPhoto']['type'], $tabTypeAuthorise)){

                $namePhoto = uniqid();

                //upload la photo sur le serveur (1 origine - 1 destination)
                move_uploaded_file($_FILES['urlPhoto']['tmp_name'], 'www/images/cocktails/'.$namePhoto);

                $nom = $_POST['nom'];
                $description = $_POST['description'];
                $dateConception = $_POST['dateConception'];
                $prixMoyen = $_POST['prixMoyen'];
                $idFamille = $_POST['idFamille'];
                $urlPhoto = $namePhoto;

                //appel de la fonction qui va insérer dans la bdd
                ajouterCocktail($nom, $description, $dateConception, $prixMoyen, $idFamille, $urlPhoto);

                //redirection
                header("Location:index.php");

            }else{
                $errorFile = "Mauvais type de fichier";
            }
        }else{
            $errorFile = "Fichier trop volumineux";
        }

    }

    $listFamille = getListFamille();

    include 'templates/ajouter_cocktail.phtml';