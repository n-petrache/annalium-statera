<?php
/**
 * Modèle de la table castes
 */
class castes extends database{
    public $id = 0;
    public $name = '';
    public $description = '';
    
    public function __construct() {
        parent::__construct();
        $this->connectDB();
    }
    
    public function getCastesList(){
        $query = 'SELECT `id`, `name`, `description` FROM `annaliumStatera_castes`';
        $queryResult = $this->pdo->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }
}