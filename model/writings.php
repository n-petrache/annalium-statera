<?php

/**
 * Modèle de la table writings
 */
class writings extends database {

    public $id = 0;
    public $title = '';
    public $fileName = '';

    public function __construct() {
        parent::__construct();
        $this->connectDB();
    }

    public function getWritingsList() {
        $query = 'SELECT `id`, `title`, `fileName` FROM `annaliumStatera_writings`';
        $queryResult = $this->pdo->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

    public function getWritingById() {
        $query = 'SELECT `title`, `fileName` FROM `annaliumStatera_writings` WHERE `id` = :id';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($queryResult->execute()) {
            $userResult = $queryResult->fetch(PDO::FETCH_OBJ);
            $this->title = $userResult->title;
            $this->fileName = $userResult->fileName;
            return true;
        } else {
            return false;
        }
    }

    public function addWriting() {
        $insert = 'INSERT INTO `annaliumStatera_writings` (`title`,`fileName`) '
                . 'VALUES (:title, :fileName)';
        $queryPrepare = $this->pdo->prepare($insert);
        $queryPrepare->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryPrepare->bindValue(':fileName', $this->fileName, PDO::PARAM_STR);
        return $queryPrepare->execute();
    }

    public function modifyWriting() {
        $query = 'UPDATE `annaliumStatera_writings` '
                . 'SET `title` = :title, `fileName` = :fileName WHERE `id` = :id ';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':title', $this->title, PDO::PARAM_STR);
        $queryResult->bindValue(':fileName', $this->fileName, PDO::PARAM_STR);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    public function deleteWriting() {
        $query = 'DELETE FROM `annaliumStatera_writings` WHERE `id` = :id';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }
}