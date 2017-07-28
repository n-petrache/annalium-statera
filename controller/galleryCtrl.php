<?php

 //Instanciation de la classe pictures  
$pictures = new pictures();
//On vérifie que l'on passe bien un entier pour le supprimer
if(isset($_GET['deletePicId']) && is_numeric($_GET['deletePicId']) ){
    $pictures->id = $_GET['deletePicId'];
    $pictures->deletePic();
}
//On vérifie si des données son passée en post
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