<?php
/**
 * Modèle de la table religions
 */
class religions extends database{
    public $id = 0;
    public $name = '';
    public $description = '';
    
    public function __construct() {
        parent::__construct();
        $this->connectDB();
    }
    
    public function getReligionsList(){
        $query = 'SELECT `id`, `name`, `description` FROM `annaliumStatera_religions`';
        $queryResult = $this->pdo->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }
}