<?php

 //Instanciation de la classe pictures  
$pictures = new pictures();
//On vérifie que l'on passe bien un entier pour le supprimer
if(isset($_GET['deletePicId']) && is_numeric($_GET['deletePicId']) ){
    $pictures->id = $_GET['deletePicId'];
    $pictures->deletePic();
}
//On vérifie si des données sont passées en post
if(isset($_POST['categories'])){
    //On passe à l'attribut categoryId la valeur choisie sur la liste déroulante
    $pictures->categoryId = $_POST['categories'];
}
//appel de la méthode getPicsListByCategory qui me renvoie un tableau d'objet
$picsList = $pictures->getPicsListByCategory();

//Instanciation de la classe categories
$categories = new categories();
//appel de la méthode getCategoriesList pour pouvoir construire la liste déroulante
$categoriesList = $categories->getCategoriesList();

////Si on appuie sur le bouton modifier dans la page gallery
//if (isset($_GET['modifyPicId'])) {
//    //on passe à l'attribut la valeur de l'id de l'image à modifier
//    $pictures->id = $_GET['modifyPicId'];
//    //on récupère les infos de l'image
//    $pictures->getPicById();
//}

$regexFile = '/^[-a-z\p{L}\s-]+\.png$/';

//déclaration d'un tableau d'erreur
$errorList = array();
$message = '';
if (isset($_POST['addTrivia'])) {
    if (!empty($_POST['name'])) {
        $pictures->title = strip_tags($_POST['name']);
    } else {
        $errorList['name'] = EMPTY_VALUE;
    }
    if (!empty($_POST['fileName'])) {
        $pictures->fileName = strip_tags($_POST['fileName']);
        if (!preg_match($regexFile, $pictures->fileName)) {
            $errorList['fileName'] = PIC_ERROR_FILENAME;
        }
    } else {
        $errorList['fileName'] = EMPTY_VALUE;
    }
    if (!empty($_POST['category'])) {
        $pictures->casteId = strip_tags($_POST['category']);
        if (!is_numeric($pictures->casteId)) {
            $errorList['category'] = PIC_ERROR_SELECT;
        }
    } else {
        $errorList['caste'] = EMPTY_VALUE;
    }
    if (!empty($_POST['description'])) {
        $pictures->description = strip_tags($_POST['description']);
    } else {
        $errorList['description'] = EMPTY_VALUE;
    }
    if (!empty($_POST['id'])) {
        $pictures->id = strip_tags($_POST['id']);
    }
//On compte le nombre de lignes pour savoir si il y a eu une erreur dans la saisie
    if (count($errorList) == 0) {
//Dans le cas où on enregistre une nouvelle anecdote, l'id sera égal à 0
        if ($_POST['id'] == 0) {
//Si PDO renvoie une erreur on le signale à l'utilisateur
            if (!$pictures->addTrivia()) {
                $message = PIC_ERROR_SEND;
            } else {
                $message = PIC_SUCCESS_SEND;
            }
        } else if (!is_numeric($_POST['id'])) {
            $message = PIC_ERROR;
//        } else {
//            if ($pictures->modifyTrivia()) {
//                $message = PIC_SUCCESS_MODIFY;
//            } else {
//                $message = PIC_ERROR_MODIFY;
//            }
        }
    }
}