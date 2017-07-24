<?php

$trivias = new trivias();
//On vérifie que l'on passe bien un entier pour le supprimer
if(isset($_GET['deleteTriviaId']) && is_numeric($_GET['deleteTriviaId']) ){
    $trivias->id = $_GET['deleteTriviaId'];
    $trivias->deleteTrivia();
}
//Si on appuie sur le bouton modifier dans la page index
if (isset($_GET['modifyTriviaId'])) {
    //on passe à l'attribut la valeur de l'id du personnage à modifier
    $trivias->id = $_GET['modifyTriviaId'];
    //on récupère les infos du personnage
    $trivias->getTriviaById();
}

$triviasList = $trivias->getTriviasList();