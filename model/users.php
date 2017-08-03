<?php

/**
 * Modèle de la table users.
 * Ce modèle est la réplique de la table.
 * Ici je la déclare
 * Le mot clé extends permet de dire que la classe users hérite de la classe database
 */
class users extends database {

    /**
     * Déclaration des champs de la table en attribut.
     * Dans une classe les variables globales sont appelées attributs
     * @var type 
     */
    public $id = 0;
    public $login = '';
    public $password = '';
    public $groupId = 0;

    /**
     * Déclaration de la méthode magique construct.
     * Le constructeur de la classe est appelé avec le mot clé new.
     */
    public function __construct() {
        parent::__construct();
        $this->connectDB();
    }

    /**
     * Méthode qui permet de récupérer les informations d'un utilisateur.
     * @return boolean
     */
    public function getUserById() {
        $query = 'SELECT `login`, `password` FROM `annaliumStatera_users` WHERE `id` = :id';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($queryResult->execute()) {
            $userResult = $queryResult->fetch(PDO::FETCH_OBJ);
            $this->login = $userResult->login;
            $this->password = $userResult->password;
            return true;
        } else {
            return false;
        }
    }
    /**
     * Méthode permettant de récupérer la liste des utilisateurs de la table users.
     * @return Array
     */
    public function getUsersListByGroup() {
        $query = 'SELECT `us`.`id`, `us`.`login`, `us`.`password`, `grp`.`name` AS `groupName` '
                . 'FROM `annaliumStatera_users` AS `us` '
                . 'INNER JOIN `annaliumStatera_usersGroups` AS `grp` '
                . 'ON `us`.`groupId` = `grp`.`id`';
        if ($this->groupId == 0) {
            $queryResult = $this->pdo->query($query);
        } else {
            $query .= ' WHERE `groupId` = :groupId';
            $queryResult = $this->pdo->prepare($query);
            $queryResult->bindValue(':groupId', $this->groupId, PDO::PARAM_INT);
            $queryResult->execute();
        }
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Methode permettant de supprimer un utilisateur
     * @return boolean
     */
    public function deleteUser() {
        $query = 'DELETE FROM `annaliumStatera_users` WHERE `id` = :id';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    /**
     * Methode permettant d'ajouter un nouvel utilisateur
     * @return boolean
     */
    public function addUser() {
        $insert = 'INSERT INTO `annaliumStatera_users` (`id`,`login`,`password`,`groupId`) '
                . 'VALUES (NULL,:login,:password,:groupId)';
        $queryPrepare = $this->pdo->prepare($insert);
        $queryPrepare->bindValue(':login', $this->login, PDO::PARAM_STR);
        $queryPrepare->bindValue(':password', $this->password, PDO::PARAM_STR);
        $queryPrepare->bindValue(':groupId', $this->groupId, PDO::PARAM_INT);
        return $queryPrepare->execute();
    }

    public function modifyUser() {
        $query = 'UPDATE `annaliumStatera_users` '
                . 'SET `login` = :login, `password` = :password, `groupId` = :groupId '
                . 'WHERE `id` = :id ';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':login', $this->login, PDO::PARAM_STR);
        $queryResult->bindValue(':password', $this->password, PDO::PARAM_STR);
        $queryResult->bindValue(':groupId', $this->groupId, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    /**
     * Fonction permettant de récupérer le hash en fonction du login
     */
    public function getHashByUser() {
        $isOk = false;
        $select = 'SELECT `password` FROM `annaliumStatera_users` '
                . 'WHERE `login` = :login';
        $queryPrepare = $this->pdo->prepare($select);
        $queryPrepare->bindValue(':login', $this->login, PDO::PARAM_STR);
        //Si la requête s'éxecute sans erreur
        if ($queryPrepare->execute()) {
            //On récupère le hash
            $result = $queryPrepare->fetch(PDO::FETCH_OBJ);
            //Si result est un objet (donc si on a récupéré et stocké notre résultat dans result)
            if (is_object($result)) {
                //On donne à l'attribut de notre objet créé dans le controller 
                //la valeur de l'attribut password de notre objet resultat
                $this->password = $result->password;
                //On passe notre variable à true, pour dire qu'il n'y a pas d'erreur
                $isOk = true;
            }
        }
        //Si $isOk est à false, aucune condition n'est remplie, il y a une erreur, 
        //on pourra afficher un message
        //Si elle est à true, toutes les conditions sont remplies est on pourra executer la suite
        return $isOk;
    }

    /**
     * Fonction permettant de compter le nombre de personnes ayant le login donné
     * Retourne le nombre de lignes trouvées
     * 0 -> aucun utilisateur avec ce nom n'existe, on peut créer le nouvel utilisateur
     * 1 -> un utilisateur avec ce nom existe, on ne crée pas le nouvel utilisateur
     * @return INT
     */
    public function checkUser() {
        $select = 'SELECT COUNT(*) AS `exists` FROM `annaliumStatera_users` '
                . 'WHERE `login` = :login';
        $queryPrepare = $this->pdo->prepare($select);
        $queryPrepare->bindValue(':login', $this->login, PDO::PARAM_STR);
        $queryPrepare->execute();
        $result = $queryPrepare->fetch(PDO::FETCH_OBJ);
        return $result->exists;
    }

}
