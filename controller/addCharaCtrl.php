<?php

//Instanciation de la classe astroSigns
$astroSigns = new astroSigns();
//Appel de la méthode getAstroSignsList pour pouvoir construire la liste déroulante
$astroSignsList = $astroSigns->getAstroSignsList();

//Instanciation de la classe religions
$religions = new religions();
//Appel de la méthode getReligionsList pour pouvoir construire la liste déroulante
$religionsList = $religions->getReligionsList();

//Instanciation de la classe castes
$castes = new castes();
//Appel de la méthode getCastesList pour pouvoir construire la liste déroulante
$castesList = $castes->getCastesList();

//Instanciation de la classe characters
$characters = new characters();

//Si on appuie sur le bouton modifier dans la page characters
if (isset($_GET['modifyCharaId'])) {
    //On passe à l'attribut la valeur de l'id du personnage à modifier
    $characters->id = $_GET['modifyCharaId'];
    //On récupère les infos du personnage
    $characters->getCharaById();
}

$regexName = '/^[-a-z\p{L}\s-]+$/i';
$regexAge = '/^(0|([1-9])|([1-9][0-9]))$/';
$regexDate = '/^Inconnue$|^(((1er|[2-9])|([1-2][0-9])|(3[0-1]))\ (Janvier|Février|Mars|Avril|Mai|Juin|Juillet|Août|Septembre|Octobre|Novembre|Décembre))$/';
$regexFile = '/^Néant$|^[-a-z\p{L}\s-]+\.png$/';

//déclaration d'un tableau d'erreur
$errorList = array();
$message = '';
//On vérifie qu'on a bien cliqué sur le bouton d'ajout
if (isset($_POST['addChara'])) {
    if (!empty($_POST['lastName'])) {
        $characters->lastName = strip_tags($_POST['lastName']);
        if (!preg_match($regexName, $characters->lastName)) {
            $errorList['lastName'] = ADDCHARA_ERROR_LASTNAME;
        }
    } else {
        $errorList['lastName'] = EMPTY_VALUE;
    }
    if (!empty($_POST['firstName'])) {
        $characters->firstName = strip_tags($_POST['firstName']);
        if (!preg_match($regexName, $characters->firstName)) {
            $errorList['firstName'] = ADDCHARA_ERROR_FIRSTNAME;
        }
    } else {
        $errorList['firstName'] = EMPTY_VALUE;
    }
    if (!empty($_POST['age']) || $_POST['age'] == 0) {
        $characters->age = strip_tags($_POST['age']);
        if (!preg_match($regexAge, $characters->age)) {
            $errorList['age'] = ADDCHARA_ERROR_AGE;
        }
    } else {
        $errorList['age'] = EMPTY_VALUE;
    }
    if (!empty($_POST['birthday'])) {
        $characters->birthday = strip_tags($_POST['birthday']);
        if (!preg_match($regexDate, $characters->birthday)) {
            $errorList['birthday'] = ADDCHARA_ERROR_BIRTHDAY;
        }
    } else {
        $errorList['birthday'] = EMPTY_VALUE;
    }
    if (!empty($_POST['astroSign'])) {
        $characters->astroSignId = strip_tags($_POST['astroSign']);
        if (!is_numeric($characters->astroSignId)) {
            $errorList['astroSign'] = ADDCHARA_ERROR_SELECT;
        }
    } else {
        $errorList['astroSign'] = EMPTY_VALUE;
    }
    if (!empty($_POST['religion'])) {
        $characters->religionId = strip_tags($_POST['religion']);
        if (!is_numeric($characters->religionId)) {
            $errorList['religion'] = ADDCHARA_ERROR_SELECT;
        }
    } else {
        $errorList['religion'] = EMPTY_VALUE;
    }
    if (!empty($_POST['caste'])) {
        $characters->casteId = strip_tags($_POST['caste']);
        if (!is_numeric($characters->casteId)) {
            $errorList['caste'] = ADDCHARA_ERROR_SELECT;
        }
    } else {
        $errorList['caste'] = EMPTY_VALUE;
    }
    if (!empty($_POST['portraitFile'])) {
        $characters->portraitFile = strip_tags($_POST['portraitFile']);
        if (!preg_match($regexFile, $characters->portraitFile)) {
            $errorList['portraitFile'] = ADDCHARA_ERROR_PORTRAIT;
        }
    } else {
        $errorList['portraitFile'] = EMPTY_VALUE;
    }
    if (!empty($_POST['description'])) {
        $characters->description = strip_tags($_POST['description']);
    } else {
        $errorList['description'] = EMPTY_VALUE;
    }
    if (!empty($_POST['id'])) {
        $characters->id = strip_tags($_POST['id']);
    }
//On compte le nombre de lignes pour savoir si il y a eu une erreur dans la saisie
    if (count($errorList) == 0) {
//Dans le cas où on enregistre un nouveau personnage, l'id sera égal à 0
        if ($_POST['id'] == 0) {
//Si PDO renvoie une erreur on le signale à l'utilisateur
            if (!$characters->addChara()) {
                $message = ADDCHARA_ERROR_SEND;
            } else {
                $message = ADDCHARA_SUCCESS_SEND;
            }
        } else if (!is_numeric($_POST['id'])) {
            $message = ADDCHARA_ERROR;
        } else {
            if ($characters->modifyChara()) {
                $message = ADDCHARA_SUCCESS_MODIFY;
            } else {
                $message = ADDCHARA_ERROR_MODIFY;
            }
        }
    }
}