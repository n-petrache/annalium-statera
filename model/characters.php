<?php

/**
 * Modèle de la table users.
 * Ce modèle est la réplique de la table.
 * Ici je la déclare
 * Le mot clé extends permet de dire que la classe users hérite de la classe database
 */
class characters extends database {

    /**
     * Déclaration des champs de la table en attribut.
     * Dans une classe les variables globales sont appelées attributs
     * @var type 
     */
    public $id = 0;
    public $lastName = '';
    public $firstName = '';
    public $age = 0;
    public $birthday = '';
    public $astroSignId = 0;
    public $religionId = 0;
    public $casteId = 0;
    public $portraitLink = '';
    public $description = '';

    /**
     * Déclaration de la méthode magique construct.
     * Le constructeur de la classe est appelé avec le mot clé new.
     */
    public function __construct() {
        parent::__construct();
        $this->connectDB();
    }

    /**
     * Méthode permettant de récupérer la liste des utilisateurs de la table users.
     * @return Array
     */
    public function getCharaByReligion() {
        $q = 'SELECT `us`.`id`, '
                . 'CONCAT(`us`.`lastName`," ", `us`.`firstName`) AS `name`, '
                . '`birthDate`, '
                . 'CONCAT(`us`.`address`," ", `us`.`postalCode`) AS `address`, '
                . '`us`.`phoneNumber`, '
                . '`dep`.`name` AS `serviceName` '
                . 'FROM `tppdo1_users` AS `us` '
                . 'INNER JOIN `tppdo1_departments` AS `dep` '
                . 'ON `us`.`id_tppdo1_departments` = `dep`.`id`';
        $query = 'SELECT `chara`.`id`, `chara`.`lastName`, `chara`.`firstName`, '
                . '`chara`.`age`, `chara`.`birthday`, '
                . '`chara`.`astroSignId`, `chara`.`religionId`, `chara`.`casteId`, '
                . '`chara`.`portraitLink`, `chara`.`description`, '
                . '`astro`.`name`, '
                . '`rel`.`name`, '
                . '`cas`.`name` '
                . 'FROM `annaliumStatera_characters` AS `chara` '
                . 'INNER JOIN `annaliumStatera_astroSigns` AS `astro` ON `astro`.`id`=`chara`.`astroSignId`'
                . 'INNER JOIN `annaliumStatera_religions` AS `rel` ON `rel`.`id`=`chara`.`religionId` '
                . 'INNER JOIN `annaliumStatera_castes` AS `cas` ON `cas`.`id`=`chara`.`casteId`';
        if ($this->religionId == 0) {
            $queryResult = $this->pdo->query($query);
        } else {
            $query .= ' WHERE `religionId` = :religionId';
            $queryResult = $this->pdo->prepare($query);
            $queryResult->bindValue(':religionId', $this->religionId, PDO::PARAM_INT);
            $queryResult->execute();
        }
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Methode permettant de supprimer un utilisateur
     * @return boolean
     */
    public function deleteChara() {
        $query = 'DELETE FROM `annaliumStatera_characters` WHERE `id` = :id';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    /**
     * Methode permettant d'ajouter un nouvel utilisateur
     * @return boolean
     */
    public function addChara() {
        $query = 'INSERT INTO `tppdo1`.`tppdo1_users` (`id`, `lastName`, `firstName`, `birthDate`, `address`, `postalCode`, `phoneNumber`, `id_tppdo1_departments`) '
                . 'VALUES (NULL, UPPER(:lastName), :firstName, STR_TO_DATE(:birthDate, \'%d/%m/%Y\'), :address, :postalCode, REPLACE(:phoneNumber, \'.\',\'\'), :id_tppdo1_departments);';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':lastName', $this->lastName, PDO::PARAM_STR);
        $queryResult->bindValue(':firstName', $this->firstName, PDO::PARAM_STR);
        $queryResult->bindValue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        $queryResult->bindValue(':address', $this->address, PDO::PARAM_STR);
        $queryResult->bindValue(':postalCode', $this->postalCode, PDO::PARAM_STR);
        $queryResult->bindValue(':phoneNumber', $this->phoneNumber, PDO::PARAM_STR);
        $queryResult->bindValue(':id_tppdo1_departments', $this->id_tppdo1_departments, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    /**
     * Méthode qui permet de récupérer les informations d'un utilisateur.
     * @return boolean
     */
    public function getCharaById() {
        $query = 'SELECT `lastName`, `firstName`, DATE_FORMAT(`birthDate`,\'%d/%m/%Y\') AS `birthDate`, `address`, `postalCode`, `phoneNumber`, `id_tppdo1_departments` FROM `annaliumStatera_characters` WHERE `id` = :id';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($queryResult->execute()) {
            $userResult = $queryResult->fetch(PDO::FETCH_OBJ);
            $this->address = $userResult->address;
            $this->lastName = $userResult->lastName;
            $this->firstName = $userResult->firstName;
            $this->birthDate = $userResult->birthDate;
            $this->phoneNumber = $userResult->phoneNumber;
            $this->postalCode = $userResult->postalCode;
            $this->id_tppdo1_departments = $userResult->id_tppdo1_departments;
            return true;
        } else {
            return false;
        }
    }

    public function modifyChara() {
        $query = 'UPDATE `annaliumStatera_characters` SET `lastName` = UPPER(:lastName), `firstName` = :firstName, `birthDate` = STR_TO_DATE(:birthDate, \'%d/%m/%Y\'), `address` = :address, `postalCode` = :postalCode, `phoneNumber` = REPLACE(:phoneNumber, \'.\',\'\'), `id_tppdo1_departments` = :id_tppdo1_departments WHERE `id` = :id ';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':lastName', $this->lastName, PDO::PARAM_STR);
        $queryResult->bindValue(':firstName', $this->firstName, PDO::PARAM_STR);
        $queryResult->bindValue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        $queryResult->bindValue(':address', $this->address, PDO::PARAM_STR);
        $queryResult->bindValue(':postalCode', $this->postalCode, PDO::PARAM_STR);
        $queryResult->bindValue(':phoneNumber', $this->phoneNumber, PDO::PARAM_STR);
        $queryResult->bindValue(':id_tppdo1_departments', $this->id_tppdo1_departments, PDO::PARAM_INT);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

}