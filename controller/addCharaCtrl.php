<?php

//Instanciation de la classe departments
$astroSigns = new astroSigns();
//appel de la méthode getDepartmentsList pour pouvoir construire la liste déroulante
$astroSignsList = $astroSigns->getAstroSignsList();

//Instanciation de la classe religions
$religions = new religions();
//appel de la méthode getReligionsList pour pouvoir construire la liste déroulante
$religionsList = $religions->getReligionsList();

//Instanciation de la classe religions
$castes = new castes();
//appel de la méthode getReligionsList pour pouvoir construire la liste déroulante
$castesList = $castes->getCastesList();

//Instanciation de la classe user
$characters = new characters();

//Si on appuie sur le bouton modifier dans la page index
if (isset($_GET['modifyId'])) {
    //on passe à l'attribut la valeur de l'id du personnage à modifier
    $characters->id = $_GET['modifyId'];
    //on récupère les infos du personnage
    $characters->getCharaById();
}

$regexName = '/^[-a-z\p{L}\s-]+$/i';
$regexAge = '/^([1-9])|([1-9][0-9])$/';
$regexDate = '/^((1er|[2-9])|([1-2][0-9])|(3[0-1]))\ (Janvier|Février|Mars|Avril|Mai|Juin|Juillet|Août|Septembre|Octobre|Novembre|Décembre)$/';
$regexFile = '/\.png$/';

//déclaration d'un tableau d'erreur
$errorList = array();
$message = '';
if (isset($_POST['register'])) {
    if (!empty($_POST['lastName'])) {
        $characters->lastName = strip_tags($_POST['lastName']);
        if (!preg_match($regexName, $characters->lastName)) {
            $errorList['lastName'] = ADDCHARA_ERROR_LASTNAME;
        }
    } else {
        $errorList['lastName'] = ADDCHARA_EMPTY_VALUE;
    }
    if (!empty($_POST['firstName'])) {
        $characters->firstName = strip_tags($_POST['firstName']);
        if (!preg_match($regexName, $characters->firstName)) {
            $errorList['firstName'] = ADDCHARA_ERROR_FIRSTNAME;
        }
    } else {
        $errorList['firstName'] = ADDCHARA_EMPTY_VALUE;
    }
    if (!empty($_POST['age'])) {
        $characters->age = strip_tags($_POST['age']);
        if (!preg_match($regexAge, $characters->age)) {
            $errorList['age'] = ADDCHARA_ERROR_AGE;
        }
    } else {
        $errorList['age'] = ADDCHARA_EMPTY_VALUE;
    }
    if (!empty($_POST['birthday'])) {
        $characters->birthday = strip_tags($_POST['birthday']);
        if (!preg_match($regexDate, $characters->birthDate)) {
            $errorList['birthday'] = ADDCHARA_ERROR_BIRTHDAY;
        }
    } else {
        $errorList['birthday'] = ADDCHARA_EMPTY_VALUE;
    }
    if (!empty($_POST['astroSign'])) {
        $characters->astroSignId = strip_tags($_POST['astroSign']);
        if (!is_numeric($characters->astroSignId)) {
            $errorList['astroSign'] = ADDCHARA_ERROR_ASTRO;
        }
    } else {
        $errorList['astroSign'] = ADDCHARA_EMPTY_VALUE;
    }
    if (!empty($_POST['religion'])) {
        $characters->religionId = strip_tags($_POST['religion']);
        if (!is_numeric($characters->religionId)) {
            $errorList['religion'] = ADDCHARA_ERROR_RELIGION;
        }
    } else {
        $errorList['religion'] = ADDCHARA_EMPTY_VALUE;
    }
    if (!empty($_POST['caste'])) {
        $characters->casteId = strip_tags($_POST['caste']);
        if (!is_numeric($characters->casteId)) {
            $errorList['caste'] = ADDCHARA_ERROR_CASTE;
        }
    } else {
        $errorList['caste'] = ADDCHARA_EMPTY_VALUE;
    }
    if (!empty($_POST['portraitFile'])) {
        $characters->portraitFile = strip_tags($_POST['portraitFile']);
        if (!preg_match($regexFile, $characters->portraitFile)) {
            $errorList['portraitFile'] = ADDCHARA_ERROR_PORTRAIT;
        }
    } else {
        $errorList['portraitFile'] = ADDCHARA_EMPTY_VALUE;
    }
    if (!empty($_POST['description'])) {
        $characters->description = strip_tags($_POST['description']);
        if (!preg_match($regexPhone, $characters->description)) {
            $errorList['description'] = ADDCHARA_ERROR_DESCRIPTION;
        }
    } else {
        $errorList['description'] = ADDCHARA_EMPTY_VALUE;
    }
    if (!empty($_POST['id'])) {
        $characters->id = strip_tags($_POST['id']);
    }
//On compte le nombre de lignes pour savoir si il y a eu une erreur dans la saisie
    if (count($errorList) == 0) {
//Dans le cas où on enregistre un nouveau personnage l'id sera = à 0
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
            if ($characters->modifyUser()) {
                $message = ADDCHARA_SUCCESS_MODIFY;
            } else {
                $message = ADDCHARA_ERROR_MODIFY;
            }
        }
    }
}