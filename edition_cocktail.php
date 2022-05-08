<?php

    require_once './lib/database.php';
    require_once './models/cocktail.php';

    connexionMySQL();

    if(
        isset($_POST['nom']) && !empty($_POST['nom']) && 
        isset($_POST['description']) && !empty($_POST['description']) && 
        isset($_POST['dateConception']) && !empty($_POST['dateConception']) && 
        isset($_POST['prixMoyen']) && !empty($_POST['prixMoyen']) && 
        isset($_POST['idFamille']) &&!empty($_POST['idFamille'])
    ){

        //on teste la taille du fichier pour voir si il est inferieur à 2MO
        if($_FILES['urlPhoto']['size'] < 2000000){

            //on crée un tableau pour les types de fichier que l'on veux autoriser
            $tabTypeAuthorise = ['image/png', 'image/jpeg'];

            //on teste si le type du fichier est présent dans le tableau des types autorisés
            if(in_array($_FILES['urlPhoto']['type'], $tabTypeAuthorise)){

                $result = getOneCocktailById($_GET['id']);

                //vérification de la présence de la photo sur le serveur
                if(is_file('www/images/cocktails/'.$result['urlPhoto'])){
                    //suppression de la photo
                    unlink('www/images/cocktails/'.$result['urlPhoto']);
                }

                //génére un nombre aleatoire
                $namePhoto = uniqid();

                //upload la photo sur le serveur (1 origine - 1 destination)
                move_uploaded_file($_FILES['urlPhoto']['tmp_name'], 'www/images/cocktails/'.$namePhoto);

                $nom = $_POST['nom'];
                $description = $_POST['description'];
                $dateConception = $_POST['dateConception'];
                $prixMoyen = $_POST['prixMoyen'];
                $idFamille = $_POST['idFamille'];
                $urlPhoto = $namePhoto;

                //appel de la fonction qui va modifier dans la bdd
                modifierCocktail($_GET['id'], $nom, $description, $dateConception, $prixMoyen, $idFamille, $urlPhoto);

                //suppression des anciennes relations
                deleteIngredientByCocktail($_GET['id']);

                //boucle sur les ingredients pour faire autant de INSERT INTO qu'il y a d'ingredients cochés
                foreach($_POST['ingredient'] as $idIngredient){
                    ajouterCocktailIngredient($_GET['id'], $idIngredient);
                }

                //redirection
                header("Location:details_cocktail.php?id=".$_GET['id']);

            }
        }
    }

    $result = getOneCocktailById($_GET['id']);

    //chargement des données pour l'affichage du formulaire
    $listFamille = getListFamille();
    $listAllIngredients = getAllIngredients();

    //chargement des ingredients du cocktail
    $listIngredientCocktail = getIngredientByCocktail($_GET['id']);
    //création d'un tableau vide pour l'utiliser dans le in_array (dans le phtml)
    $tabIdCocktail = array();
    //boucle sur les ingredient du coctail
    foreach($listIngredientCocktail as $row){
        //ajout des id uniquement dans le tableau
        array_push($tabIdCocktail, $row['id']);
    }

    include './templates/edition_cocktail.phtml';
