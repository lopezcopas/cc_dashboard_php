<?php
    require(dirname(__FILE__) . '/config.php');

    class Database{
        //DB Params
        private $host = DATABASE_HOST;
        private $username = DATABASE_USER;
        private $password = DATABASE_PASS;
        private $db_name = DATABASE_NAME;
        private $conn;
    
        //DB Connect
        public function connect(){
          $this->conn = null;
          try{
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name,
            $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          }catch(PDOException $e){
            echo 'Connection Error: ' . $e->getMessage();
          }
    
          return $this->conn;
        }
    }
?>