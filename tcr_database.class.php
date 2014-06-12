<?php
/*
Plugin Name: TCR database PDO Class
Description: Adds a basic PDO database abstraction layer for custom queries
Version: 1.0
Plugin URI: http://thecellarroom.net
Author: The Cellar Room Limited
Author URI: http://www.thecellarroom.net
Copyright (c) 2014 The Cellar Room Limited
*/


// Define configuration - ideally in your wp-config.
define("PDO_HOST", "localhost");
define("PDO_USER", "***");
define("PDO_PASS", "***);
define("PDO_NAME", "***");


class Database{

    private $host      = PDO_HOST;
    private $user      = PDO_USER;
    private $pass      = PDO_PASS;
    private $dbname    = PDO_NAME;
 
    private $dbh;
    private $error;
    private $stmt;
 
    public function __construct(){
        // Set DSN
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
        // Set options
        $options = array(
            PDO::ATTR_PERSISTENT    => true,
            PDO::ATTR_ERRMODE       => PDO::ERRMODE_EXCEPTION
        );
        // Create a new PDO instanace
        try{
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        }
        // Catch any errors
        catch(PDOException $e){
            $this->error = $e->getMessage();
        }
    }

    public function query($query){
        $this->stmt = $this->dbh->prepare($query);
    }
    
    public function bind($param, $value, $type = null){
                if (is_null($type)) {
                  switch (true) {
                    case is_int($value):
                      $type = PDO::PARAM_INT;
                      break;
                    case is_bool($value):
                      $type = PDO::PARAM_BOOL;
                      break;
                    case is_null($value):
                      $type = PDO::PARAM_NULL;
                      break;
                    default:
                      $type = PDO::PARAM_STR;
                  }
            }
        $this->stmt->bindValue($param, $value, $type);
    }
    
    public function execute(){
        return $this->stmt->execute();
    }
    
    public function resultset(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function rowCount(){
        return $this->stmt->rowCount();
    }
    
    public function lastInsertId(){
        return $this->dbh->lastInsertId();
    }
    
}

?>
