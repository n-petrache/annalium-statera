<?php
/**
 * Modèle de la table astroSigns
 */
class astroSigns extends database{
    public $id = 0;
    public $name = '';
    
    public function __construct() {
        parent::__construct();
        $this->connectDB();
    }
    
    public function getAstroSignsList(){
        $query = 'SELECT `id`, `name` FROM `annaliumStatera_astroSigns`';
        $queryResult = $this->pdo->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }
}