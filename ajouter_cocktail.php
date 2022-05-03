<?php

require_once 'lib/database.php';
require_once 'models/cocktail.php';

//connexion a la bdd
connexionMySQL();



//bloc permettant d'afficher les erreurs dans la page
$errorName = "";
if (isset($_POST['nom']) && empty($_POST['nom'])) {
    $errorName =  'Attention vous n\'avez pas remplis le nom';
}

$errordescription = "";
if (isset($_POST['description']) && empty($_POST['description'])) {
    $errordescription =  'Attention vous n\'avez pas remplis la description';
}

$errorFile = "";

//on test si tous les champs du formulaire sont bon alors on fais l'enregistrement en bdd
if (
    isset($_POST['nom']) && !empty($_POST['nom']) &&
    isset($_POST['description']) && !empty($_POST['description']) &&
    isset($_POST['dateConception']) && !empty($_POST['dateConception']) &&
    isset($_POST['prixMoyen']) && !empty($_POST['prixMoyen']) &&
    isset($_POST['idFamille']) && !empty($_POST['idFamille'])
) {

    //on test la taille du fichier pour voir si il est inferieur a 2MO
    if ($_FILES['urlPhoto']['size'] < 2000000) {

        //on créer un tableau pour les type de fichier que l'on veux autoriser
        $tabTypeAuthorise = ['image/png', 'image/jpeg'];

        //on test si si le type du fichier est présent dans le tableau des types autorisées
        if (in_array($_FILES['urlPhoto']['type'], $tabTypeAuthorise)) {

            $namePhoto = uniqid();

            //upload la photo sur le serveur (1 origine - 1 destination)
            move_uploaded_file($_FILES['urlPhoto']['tmp_name'], 'www/images/cocktails/' . $namePhoto);

            $nom = $_POST['nom']; //= nom du nouveau cocktail
            $description = $_POST['description'];
            $dateConception = $_POST['dateConception'];
            $prixMoyen = $_POST['prixMoyen'];
            $idFamille = $_POST['idFamille'];
            $urlPhoto = $namePhoto;
            $idIngredients = $_POST['ingredient']; //ici on récupère le tableau ingredient sélectionné
            //var_dump($idIngredients);
            // die();

            //appel de la fonction qui va inserer dans la bdd et on récupère l'id du cocktail ajouté dans une variable
            //(cf. requête SQL addCocktail() avec le "return $database->lastInsertId();" qui permet de sauvegarder l'id du dernier élément ajouté dans la database)
            $idCocktail = addCocktail($nom, $description, $dateConception, $prixMoyen, $idFamille, $urlPhoto);

            //on fait une boucle sur le tableau d'ingrédients sélectionnés et on appelle la fonction pour ajouter un ingredient à l'intérieur de la boucle pour que l'opération se répète pour chaque ingrédient ajouté
            foreach ($idIngredients as $idIngredient) {
                addCocktailIngredients($idCocktail, $idIngredient);
            }

            //redirection
            header("Location:index.php");
        } else {
            $errorFile = "Mauvais type de fichier";
        }
    } else {
        $errorFile = "Fichier trop volumineux";
    }
}

$listFamille = getListFamille();
$listIngredients = getAllIngredients();



include 'templates/ajouter_cocktail.phtml';
