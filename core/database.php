<?php

class database {
    private $conn;
    private $config;

   
    public function __construct() {
     
        $this->config = require_once 'config.php';
    }

  
    public function getConnection() {
        $this->conn = null;
        
    
        $dbConfig = $this->config['db'];

        try {
            $this->conn = new PDO("mysql:host=" . $dbConfig['host'] . ";dbname=" . $dbConfig['db_name'], $dbConfig['username'], $dbConfig['password']);
          
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
       
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}
?>
