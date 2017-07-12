<?php
$characters = new characters();
//On vérifie si des données son passée en post
if(isset($_POST['religions'])){
    //On passe à l'attribut religionId la valeur choisie sur la liste déroulante
    $characters->religionId = $_POST['religions'];
}
//appel de la méthode getCharaByReligion qui me renvoie un tableau d'objet
$charaList = $characters->getCharaByReligion();

//Instanciation de la classe religions
$religions = new religions();
//appel de la méthode getReligionsList pour pouvoir construire la liste déroulante
$religionsList = $religions->getReligionsList();