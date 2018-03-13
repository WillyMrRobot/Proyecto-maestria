<?php
//Clase abstracta, se puede heredar, pero no se puede instanciar
class database extends PDO {
    
    private $engine;
    private $host;
    private $database;
    private $dns;
    private $user;
    private $pass;
    
    /* public function __construct() { 
        $this->engine = 'mysql'; 
        $this->host = 'localhost'; 
        $this->database = 'whitetec_college'; 
        $this->user = 'whitetec_admin'; 
        $this->pass = 'TechWhite*2015'; 
        $this->dns = $this->engine.':dbname='.$this->database.';host='.$this->host; 
        parent::__construct( $this->dns, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\'')); 
      
    } */
    
    public function __construct() {
        $this->engine = 'mysql';
        $this->host = 'localhost';
        $this->database = 'maestria';
        $this->user = 'wb';
        $this->pass = '123';
        $this->dns = $this->engine.':dbname='.$this->database.';host='.$this->host;
        parent::__construct( $this->dns, $this->user, $this->pass, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
        
    }
    
}
?>