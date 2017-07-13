<?php

/**
 * Déclaration des constantes de connexion à la base de données
 */
define('HOST','localhost');
define('LOGIN','noya');
define('PWD','taka');
define('DB','annaliumStatera');
//define('LANG_FOLDER', 'lang/');
//
///* simplexml_load_file() convertit un fichier xml en un objet qui fonctionne comme un tableau */
///** Déclaration de la variable xml : utilisation de la méthode (fonction) simplexml_load_file() qui permet 
// * de récupérer le fichier xml et de le convertir en tableau associatif avec pour clés les noms des noeuds. */
//$xml = simplexml_load_file('source.xml');
///** Affiche le fichier XML sous forme de tableau associatif var_dump($getXml); * */
///** Initialisation de la variable $numberPage à 0 car $xml peut être comparé à un tableau et le 
// * noeud "page d'id = 1" est à la place [0] càd que l'utilisateur sera quoiqu'il se passe sur la page d'accueil. */
//$pageNumber = 0;
//// Si la variable super globale $_GET n'est pas NULL
//if (!empty($_GET['pageNumber'])) {
//    // Déclaration d'une variable temporaire en utilisant la fonction strip_tags pour supprimer les balises html
//    $pageNumberTemp = strip_tags($_GET['pageNumber']);
//    /** Si la variable temporaire est bien une valeur numérique (fonction is_numérique()) et si la valeur de la 
//     * variable $numberPageTemp est bien compris entre 1 et 4 (fonction count() qui permet de connaitre le nombre 
//     * de page dans le fichier xml) alors */
//    if (is_numeric($pageNumberTemp) && $pageNumberTemp <= count($xml->page)) {
//        /** on déclare la variable $numberPage en utilisant la fonction intval qui convertie en entier -1 car 
//         * comme nous récupérons l'id qui est 1 alors que la première clé est 0 */
//        $pageNumber = intval($pageNumberTemp) - 1;
//    }
//}