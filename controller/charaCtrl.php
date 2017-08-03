<?php
$characters = new characters();
//On vérifie que l'on passe bien un entier pour le supprimer
if(isset($_GET['deleteCharaId']) && is_numeric($_GET['deleteCharaId']) ){
    $characters->id = $_GET['deleteCharaId'];
    $characters->deleteChara();
}
//On vérifie si des données sont passées en post
if(isset($_POST['religions'])){
    //On passe à l'attribut religionId la valeur choisie sur la liste déroulante
    $characters->religionId = $_POST['religions'];
}
//Appel de la méthode getCharaByReligion qui me renvoie un tableau d'objet
$charaList = $characters->getCharaByReligion();

//Instanciation de la classe religions
$religions = new religions();
//Appel de la méthode getReligionsList pour pouvoir construire la liste déroulante
$religionsList = $religions->getReligionsList();