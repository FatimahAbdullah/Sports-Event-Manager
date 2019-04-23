<?php 
  class Database {
    // DB Params
    private $host = 'localhost';
    private $db_name = 'sportseventmanager';
    private $username = 'root';
    private $password = '';
    private $connection;

    // DB Connection 
    public function connect() {
      $this->connection = null;

      try { 
        $this->connection = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->connection;
    }
  }