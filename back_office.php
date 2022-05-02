<?php

    require_once 'lib/database.php';
    require_once 'models/cocktail.php';
  

    //connexion a la bdd
    connexionMySQL();

    $listCocktail = getAllCocktail();









    include 'templates/back_office.phtml';