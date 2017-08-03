<?php

//Déclaration de la variable $userError
$userError = false;

//Instanciation de l'objet user
$users = new users();

//On vérifie si l'on a bien appuyé sur le bouton Enregistrer
if (isset($_POST['subscribe'])) {
    //Si la variable POST n'est pas vide
    if (!empty($_POST['pseudoI'])) {
        //On stocke sa valeur dans l'attribut login de l'objet user en sécurisant (strip_tags)
        $users->login = strip_tags($_POST['pseudoI']);
        //On vérifie avec la méthode checkUser que le login n'existe pas
        //S'il existe, on passe $userError à true (nous permet d'afficher notre message d'erreur dans la vue)
        if ($users->checkUser()) {
            $userError = true;
        }
    } else {
        //Si $_POST est vide, on passe $userError à true (nous permet d'afficher notre message d'erreur dans la vue)
        $userError = true;
    }
    //On vérifie si les $_POST password et confirmPassword sont bien rempli et qu'ils sont bien identiques
    if (!empty($_POST['passwordI']) && !empty($_POST['confirmPasswordI']) && $_POST['passwordI'] == $_POST['confirmPasswordI']) {
        //Si tout va bien, on stocke dans l'attribut password de l'objet user, la version chiffrée du mot de passe
        //On chiffre le mot de passe avec la fonction password_hash qui prend en paramètre le mot de passe envoyé 
        //et la méthode de chiffrement (cf PHP.net)
        $users->password = password_hash($_POST['passwordI'], PASSWORD_BCRYPT);
    } else {
        //Si un des $_POST est vide ou que les mots de passes ne sont pas identiques, 
        //on passe $userError à true (nous permet d'afficher notre message d'erreur dans la vue)
        $userError = true;
    }
    if (!empty($_POST['groupId'])) {
        $users->groupId = strip_tags($_POST['groupId']);
    }
    if (!empty($_POST['id'])) {
        $users->id = strip_tags($_POST['id']);
    }
    //S'il n'y a pas d'erreur, on ajoute l'utilisateur
    if (!$userError) {
        $users->addUser();
    }
}