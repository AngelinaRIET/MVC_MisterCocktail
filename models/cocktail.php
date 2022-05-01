<?php

// Ici se trouvent toutes les fonctions manipulant la base de données SQL et implémentant les fonctionnalités.
function getAllCocktail(){
    
    global $database;
    $sql = "SELECT * FROM cocktail";
    $request = $database->prepare($sql);
    $request->execute();
    $result = $request->fetchAll(PDO::FETCH_ASSOC);
    return $result;

}

function getOneCocktailById($id){
    global $database;
    $request = $database->prepare(
    "SELECT *, YEAR(dateConception) AS anneeConception 
    FROM cocktail 
    JOIN famille 
    ON famille.id = cocktail.idFamille 
    WHERE cocktail.id = :id");
    $request->execute(['id' => $id]);
    $result = $request->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function ajouterCocktail($nom, $description, $dateConception, $prixMoyen, $idFamille, $urlPhoto){

    global $database;

    $sql = "INSERT INTO cocktail
    (nom, description, urlPhoto, dateConception, prixMoyen, idFamille)
    VALUES
    (:nom, :description, :urlPhoto, :dateConception, :prixMoyen, :idFamille)";

    $request = $database->prepare($sql);

    $request->execute([
    'nom' => $nom, 
    'description' => $description, 
    'urlPhoto' => $urlPhoto, 
    'dateConception' => $dateConception, 
    'prixMoyen' => $prixMoyen, 
    'idFamille' => $idFamille
]);
}

function getListFamille(){
    global $database;

    $request = $database->prepare('SELECT * FROM famille');
    $request->execute();
    $result = $request->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}