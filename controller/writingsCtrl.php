<?php

$writings = new writings();
$writingsList = $writings->getWritingsList();

//On vérifie que l'on passe bien un entier pour le supprimer
if (isset($_GET['deleteWritingId']) && is_numeric($_GET['deleteWritingId'])) {
    $writings->id = $_GET['deleteWritingId'];
    $writings->deleteWriting();
}
////Si on appuie sur le bouton modifier dans la page writings
//if (isset($_GET['modifyWritingId'])) {
//    //on passe à l'attribut la valeur de l'id du récit à modifier
//    $writings->id = $_GET['modifyWritingId'];
//    //on récupère les infos du récit
//    $writings->getTriviaById();
//}

$regexFile = '/^[-a-z\p{L}\s-]+\.pdf$/';

//déclaration d'un tableau d'erreur
$errorList = array();
$message = '';
if (isset($_POST['addWriting'])) {
    if (!empty($_POST['title'])) {
        $writings->title = strip_tags($_POST['title']);
    } else {
        $errorList['title'] = EMPTY_VALUE;
    }
    if (!empty($_POST['fileName'])) {
        $writings->fileName = strip_tags($_POST['fileName']);
        if (!preg_match($regexFile, $writings->fileName)) {
            $errorList['fileName'] = WRITING_ERROR_FILENAME;
        }
    } else {
        $errorList['fileName'] = EMPTY_VALUE;
    }
    if (!empty($_POST['id'])) {
        $writings->id = strip_tags($_POST['id']);
    }
//On compte le nombre de lignes pour savoir si il y a eu une erreur dans la saisie
    if (count($errorList) == 0) {
//Dans le cas où on enregistre un nouveau récit, l'id sera égal à 0
        if ($_POST['id'] == 0) {
//Si PDO renvoie une erreur on le signale à l'utilisateur
            if (!$writings->addWriting()) {
                $message = WRITING_ERROR_SEND;
            } else {
                $message = WRITING_SUCCESS_SEND;
            }
        } else if (!is_numeric($_POST['id'])) {
            $message = WRITING_ERROR;
//        } else {
//            if ($writings->modifyWriting()) {
//                $message = WRITING_SUCCESS_MODIFY;
//            } else {
//                $message = WRITING_ERROR_MODIFY;
//            }
        }
    }
}