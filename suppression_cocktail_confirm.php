<?php
require_once './lib/database.php';
require_once './models/cocktail.php';

//connexion a la bdd
connexionMySQL();

if(isset($_POST['id']) && !empty($_POST['id'])){
    $result = getOneCocktailById($_POST['id']);

    //verification de la presence de la phot sur le serveur
    if(is_file('www/images/cocktails/'.$result['urlPhoto'])){
        //suppression de la photo
        unlink('www/images/cocktails/'.$result['urlPhoto']);
    }

    //suppression du cocktail en bdd
    suppressionCocktail($_POST['id']);

    //redirection
    header('Location:backoffice.php');
}else{
    //recuperation de l'id dans l'url
    $id = $_GET['id'];

    //recuperation des infos du cocktail
    $result = getOneCocktailById($id);

}

include './templates/suppression_cocktail_confirm.phtml';