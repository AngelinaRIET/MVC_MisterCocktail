<?php
$database = null; // Notre B.D.D.

function connexionMySQL(){
    global $database; // On utilise la variable globale

    // Infos de connexion
    $dsn = 'mysql:dbname=MisterCocktail;host=127.0.0.1;port=8889';
    $user = 'Angelina';
    $password = 'lapasserelle';

    // on charge l'objet PDO dans $database
    $database = new PDO($dsn, $user, $password);
}

connexionMySQL();