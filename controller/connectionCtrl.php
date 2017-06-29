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
    //On vérifie que le mot de passe saisi et le mot de passe présent dans la base sont les même grâce à password_verify
    $connectionOk = password_verify($_POST['passwordC'], $users->password);
}
?>
