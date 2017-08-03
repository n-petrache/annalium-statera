<?php

/**
 * Modèle de la table pictures
 */
class pictures extends database {

    public $id = 0;
    public $name = '';
    public $fileName = '';
    public $categoryId = 0;
    public $description = '';

    public function __construct() {
        parent::__construct();
        $this->connectDB();
    }

    public function getPicsList() {
        $query = 'SELECT `id`, `name`, `fileName`, `categoryId`, `description` '
                . 'FROM `annaliumStatera_pictures`';
        $queryResult = $this->pdo->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

    public function getPicById() {
        $query = 'SELECT `name`, `fileName`, `categoryId`, `description` '
                . 'FROM `annaliumStatera_pictures` WHERE `id` = :id';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($queryResult->execute()) {
            $userResult = $queryResult->fetch(PDO::FETCH_OBJ);
            $this->name = $userResult->name;
            $this->fileName = $userResult->fileName;
            $this->categoryId = $userResult->categoryId;
            $this->description = $userResult->description;
            return true;
        } else {
            return false;
        }
    }

    public function getPicsListByCategory() {
        $query = 'SELECT `pic`.`id`, `pic`.`name`, `pic`.`fileName`, `pic`.`categoryId`, `pic`.`description`, '
                . '`cat`.`name` AS `categoryName` '
                . 'FROM `annaliumStatera_pictures` AS `pic` '
                . 'INNER JOIN `annaliumStatera_categories` AS `cat` ON `cat`.`id`=`pic`.`categoryId` ';
        if ($this->categoryId == 0) {
            $queryResult = $this->pdo->query($query);
        } else {
            $query .= ' WHERE `categoryId` = :categoryId';
            $queryResult = $this->pdo->prepare($query);
            $queryResult->bindValue(':categoryId', $this->categoryId, PDO::PARAM_INT);
            $queryResult->execute();
        }
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

    public function addPic() {
        $insert = 'INSERT INTO `annaliumStatera_pictures` (`name`,`fileName`,`categoryId`,`description`) '
                . 'VALUES (:name, :fileName, :categoryId, :description)';
        $queryPrepare = $this->pdo->prepare($insert);
        $queryPrepare->bindValue(':name', $this->name, PDO::PARAM_STR);
        $queryPrepare->bindValue(':fileName', $this->fileName, PDO::PARAM_STR);
        $queryPrepare->bindValue(':categoryId', $this->categoryId, PDO::PARAM_INT);
        $queryPrepare->bindValue(':description', $this->description, PDO::PARAM_STR);
        return $queryPrepare->execute();
    }

    public function modifyPic() {
        $query = 'UPDATE `annaliumStatera_pictures` '
                . 'SET `name` = :name, `fileName` = :fileName, `categoryId` = :categoryId, `description` = :description '
                . 'WHERE `id` = :id ';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':name', $this->name, PDO::PARAM_STR);
        $queryResult->bindValue(':fileName', $this->fileName, PDO::PARAM_STR);
        $queryResult->bindValue(':categoryId', $this->categoryId, PDO::PARAM_INT);
        $queryResult->bindValue(':description', $this->description, PDO::PARAM_STR);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    public function deletePic() {
        $query = 'DELETE FROM `annaliumStatera_pictures` WHERE `id` = :id';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }
}
