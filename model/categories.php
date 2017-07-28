<?php

/**
 * Modèle de la table departments
 */
class categories extends database{
    public $id = 0;
    public $name = '';
    
    public function __construct() {
        parent::__construct();
        $this->connectDB();
    }
    
    public function getCategoriesList(){
        $query = 'SELECT `id`, `name` FROM `annaliumStatera_categories`';
        $queryResult = $this->pdo->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }
}