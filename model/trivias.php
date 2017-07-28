<?php

/**
 * Modèle de la table trivias
 */
class trivias extends database {

    public $id = 0;
    public $title = '';
    public $description = '';

    public function __construct() {
        parent::__construct();
        $this->connectDB();
    }

    public function getTriviasList() {
        $query = 'SELECT `id`, `title`, `description` FROM `annaliumStatera_trivias`';
        $queryResult = $this->pdo->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

    public function getTriviaById() {
        $query = 'SELECT `title`, `description` FROM `annaliumStatera_trivias` WHERE `id` = :id';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($queryResult->execute()) {
            $userResult = $queryResult->fetch(PDO::FETCH_OBJ);
            $this->title = $userResult->title;
            $this->description = $userResult->description;
            return true;
        } else {
            return false;
        }
    }

    public function deleteTrivia() {
        $query = 'DELETE FROM `annaliumStatera_trivias` WHERE `id` = :id';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    public function addTrivia() {
        $insert = 'INSERT INTO `annaliumStatera_trivias` (`title`,`description`) VALUES (:title, :description)';
        $queryPrepare = $this->pdo->prepare($insert);
        $queryPrepare->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryPrepare->bindValue(':description', $this->description, PDO::PARAM_STR);
        return $queryPrepare->execute();
    }

    public function modifyTrivia() {
        $query = 'UPDATE `annaliumStatera_trivias` '
                . 'SET `title` = :title, `description` = :description WHERE `id` = :id ';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryResult->bindValue(':description', $this->description, PDO::PARAM_STR);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

}
