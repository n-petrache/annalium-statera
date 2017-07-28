<?php

$trivias = new trivias();
$triviasList = $trivias->getTriviasList();

//On vérifie que l'on passe bien un entier pour le supprimer
if (isset($_GET['deleteTriviaId']) && is_numeric($_GET['deleteTriviaId'])) {
    $trivias->id = $_GET['deleteTriviaId'];
    $trivias->deleteTrivia();
}
////Si on appuie sur le bouton modifier dans la page index
if (isset($_GET['modifyTriviaId'])) {
    //on passe à l'attribut la valeur de l'id de l'anecdote à modifier
    $trivias->id = $_GET['modifyTriviaId'];
    //on récupère les infos de l'anecdote
    $trivias->getTriviaById();
}

//déclaration d'un tableau d'erreur
$errorList = array();
$message = '';
if (isset($_POST['addTrivia'])) {
    if (!empty($_POST['title'])) {
        $trivias->title = strip_tags($_POST['title']);
//        if (!preg_match($regexFile, $characters->portraitFile)) {
//            $errorList['title'] = TRIVIA_ERROR_TITLE;
//        }
    } else {
        $errorList['title'] = EMPTY_VALUE;
    }
    if (!empty($_POST['description'])) {
        $trivias->description = strip_tags($_POST['description']);
    } else {
        $errorList['description'] = EMPTY_VALUE;
    }
    if (!empty($_POST['id'])) {
        $trivias->id = strip_tags($_POST['id']);
    }
//On compte le nombre de lignes pour savoir si il y a eu une erreur dans la saisie
    if (count($errorList) == 0) {
//Dans le cas où on enregistre une nouvelle anecdote, l'id sera égal à 0
        if ($_POST['id'] == 0) {
//Si PDO renvoie une erreur on le signale à l'utilisateur
            if (!$trivias->addTrivia()) {
                $message = TRIVIA_ERROR_SEND;
            } else {
                $message = TRIVIA_SUCCESS_SEND;
            }
        } else if (!is_numeric($_POST['id'])) {
            $message = TRIVIA_ERROR;
        } else {
            if ($trivias->modifyTrivia()) {
                $message = TRIVIA_SUCCESS_MODIFY;
            } else {
                $message = TRIVIA_ERROR_MODIFY;
            }
        }
    }
}