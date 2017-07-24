<?php

/**
 * Modèle de la table characters.
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
    public $lastName = 'Inconnu';
    public $firstName = 'Inconnu';
    public $age = 0;
    public $birthday = 'Inconnue';
    public $astroSignId = 0;
    public $religionId = 0;
    public $casteId = 0;
    public $portraitFile = 'Néant';
    public $description = 'Néant';

    /**
     * Déclaration de la méthode magique construct.
     * Le constructeur de la classe est appelé avec le mot clé new.
     */
    public function __construct() {
        parent::__construct();
        $this->connectDB();
    }

    /**
     * Méthode permettant de récupérer la liste des personnagess de la table characters.
     * @return Array
     */
    public function getCharaByReligion() {
//        $q = 'SELECT `us`.`id`, '
//                . 'CONCAT(`us`.`lastName`," ", `us`.`firstName`) AS `name`, '
//                . '`birthDate`, CONCAT(`us`.`address`," ", `us`.`postalCode`) AS `address`, '
//                . '`us`.`phoneNumber`, `dep`.`name` AS `serviceName` '
//                . 'FROM `tppdo1_users` AS `us` '
//                . 'INNER JOIN `tppdo1_departments` AS `dep` ON `us`.`id_tppdo1_departments` = `dep`.`id`';
        $query = 'SELECT `chara`.`id`, `chara`.`lastName`, `chara`.`firstName`, '
                . '`chara`.`age`, `chara`.`birthday`, '
                . '`chara`.`astroSignId`, `chara`.`religionId`, `chara`.`casteId`, '
                . '`chara`.`portraitFile`, `chara`.`description`, '
                . '`ast`.`name` AS `astroSign`, '
                . '`rel`.`name` AS `religion`, '
                . '`cas`.`name` AS `caste` '
                . 'FROM `annaliumStatera_characters` AS `chara` '
                . 'LEFT JOIN `annaliumStatera_astroSigns` AS `ast` ON `ast`.`id`=`chara`.`astroSignId` '
                . 'LEFT JOIN `annaliumStatera_religions` AS `rel` ON `rel`.`id`=`chara`.`religionId` '
                . 'LEFT JOIN `annaliumStatera_castes` AS `cas` ON `cas`.`id`=`chara`.`casteId` ';
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
     * Methode permettant de supprimer un personnage
     * @return boolean
     */
    public function deleteChara() {
        $query = 'DELETE FROM `annaliumStatera_characters` WHERE `id` = :id';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    /**
     * Methode permettant d'ajouter un nouveau personnage
     * @return boolean
     */
    public function addChara() {
        $query = 'INSERT INTO `annaliumStatera_characters` (`id`, `lastName`, `firstName`, `age`, `birthday`, `astroSignId`, `religionId`, `casteId`, `portraitFile`, `description`) '
                . 'VALUES (NULL, :lastName, :firstName, :age, :birthday, :astroSignId, :religionId, :casteId, :portraitFile, :description);';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':lastName', $this->lastName, PDO::PARAM_STR);
        $queryResult->bindValue(':firstName', $this->firstName, PDO::PARAM_STR);
        $queryResult->bindValue(':age', $this->age, PDO::PARAM_INT);
        $queryResult->bindValue(':birthday', $this->birthday, PDO::PARAM_STR);
        $queryResult->bindValue(':astroSignId', $this->astroSignId, PDO::PARAM_INT);
        $queryResult->bindValue(':religionId', $this->religionId, PDO::PARAM_INT);
        $queryResult->bindValue(':casteId', $this->casteId, PDO::PARAM_INT);
        $queryResult->bindValue(':portraitFile', $this->portraitFile, PDO::PARAM_STR);
        $queryResult->bindValue(':description', $this->description, PDO::PARAM_STR);
        return $queryResult->execute();
    }

    /**
     * Méthode qui permet de récupérer les informations d'un personnage
     * @return boolean
     */
    public function getCharaById() {
        $query = 'SELECT `lastName`, `firstName`, `age`, `birthday`, `astroSignId`, `religionId`, `casteId`, `portraitFile`, `description` '
                . 'FROM `annaliumStatera_characters` WHERE `id` = :id';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($queryResult->execute()) {
            $userResult = $queryResult->fetch(PDO::FETCH_OBJ);
            $this->lastName = $userResult->lastName;
            $this->firstName = $userResult->firstName;
            $this->age = $userResult->age;
            $this->birthday = $userResult->birthday;
            $this->astroSignId = $userResult->astroSignId;
            $this->religionId = $userResult->religionId;
            $this->casteId = $userResult->casteId;
            $this->portraitFile = $userResult->portraitFile;
            $this->description = $userResult->description;
            return true;
        } else {
            return false;
        }
    }

    /**
     * Méthode permettant de modifier un personnage
     * @return type
     */
    public function modifyChara() {
        $query = 'UPDATE `annaliumStatera_characters` '
                . 'SET `lastName` = :lastName, `firstName` = :firstName, `age` = :age, `birthday` = :birthday, `astroSignId` = :astroSignId, `religionId` = :religionId, `casteId` = :casteId, `portraitFile` = :portraitFile, `description` = :description WHERE `id` = :id ';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':lastName', $this->lastName, PDO::PARAM_STR);
        $queryResult->bindValue(':firstName', $this->firstName, PDO::PARAM_STR);
        $queryResult->bindValue(':age', $this->age, PDO::PARAM_INT);
        $queryResult->bindValue(':birthday', $this->birthday, PDO::PARAM_STR);
        $queryResult->bindValue(':astroSignId', $this->astroSignId, PDO::PARAM_INT);
        $queryResult->bindValue(':religionId', $this->religionId, PDO::PARAM_INT);
        $queryResult->bindValue(':casteId', $this->casteId, PDO::PARAM_INT);
        $queryResult->bindValue(':portraitFile', $this->portraitFile, PDO::PARAM_STR);
        $queryResult->bindValue(':description', $this->description, PDO::PARAM_STR);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

}
