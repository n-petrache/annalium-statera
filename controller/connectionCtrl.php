<?php

//Déclaration des variables
$connectionOk = 0;

//Instanciation de l'objet user
$users = new users();

//On vérifie que l'on a bien appuyé sur le bouton connexion
if (isset($_POST['connection'])) {
    //On stocke la valeur de $_POST['login'] dans l'attribut login de l'objet user en sécurisant (strip_tags)
    $users->login = strip_tags($_POST['pseudoC']);
    //On utilise notre méthode getHashByUser pour récupérer le hash stocké dans notre base
    $users->getHashByUser();
    //On vérifie que le mot de passe saisi et le mot de passe présent dans la base sont les mêmes 
    //grâce à password_verify
    $connectionOk = password_verify($_POST['passwordC'], $users->password);
    $_SESSION['pseudoC'] = $users->login;
}
//On vérifie que l'on a bien appuyé sur le bouton déconnexion
if (isset($_GET['logout'])) {
// Détruit les données de la session
    session_unset();
// Détruit les variables de session
    session_destroy();
// On redirige le visiteur vers la page d'accueil
    header('location: index.php');
}

//appel de la méthode getUsersList qui me renvoi un tableau d'objet
$usersByGroup = $users->getUsersListByGroup();
