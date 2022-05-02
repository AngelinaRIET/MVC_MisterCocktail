<?php

    require_once 'lib/database.php';
    require_once 'models/cocktail.php';

    //connexion a la bdd
    connexionMySQL();
    
    $result = getOneCocktailById($_GET['id']);
    $errorEdit ="";
    $errorFile = "";
    $listFamille = getListFamille();

    if(
        isset($_POST['nom']) && !empty($_POST['nom']) && 
        isset($_POST['description']) && !empty($_POST['description']) && 
        isset($_POST['dateConception']) && !empty($_POST['dateConception']) && 
        isset($_POST['prixMoyen']) && !empty($_POST['prixMoyen']) && 
        isset($_POST['idFamille']) &&!empty($_POST['idFamille'])
    )
    {
         //on test la taille du fichier pour voir si il est inferieur a 2MO
        if($_FILES['urlPhoto']['size'] < 2000000)
        {

            //on créer un tableau pour les type de fichier que l'on veux autoriser
            $tabTypeAuthorise = ['image/png', 'image/jpeg'];

            //on test si si le type du fichier est présent dans le tableau des types autorisées
            if(in_array($_FILES['urlPhoto']['type'], $tabTypeAuthorise))
            {
                $namePhoto = uniqid();

               
                $nom = $_POST['nom'];
                $description = $_POST['description'];
                $dateConception = $_POST['dateConception'];
                $prixMoyen = $_POST['prixMoyen'];
                $idFamille = $_POST['idFamille'];
                $urlPhoto = $namePhoto;

                //upload la photo sur le serveur (1 origine - 1 destination)
                 move_uploaded_file($_FILES['urlPhoto']['tmp_name'], 'www/images/cocktails/'.$namePhoto);
       
        
                editCocktail($nom, $description, $dateConception, $prixMoyen, $idFamille,$urlPhoto, $_GET['id']);

       
                header("Location:details_cocktail.php?id=".$_GET['id']);
            }
            else
            {
                $errorEdit = "Vous n'avez pas rempli tous les champs";
            }
        }
    }     


    





include 'templates/edition_cocktail.phtml';