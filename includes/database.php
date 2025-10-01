<?php

class Database{
    // Database connection variables
    private $servername;
    private $username;
    private $password;
    private $dbname;

    // Method to connect to the database 'doodle_db'
    public function connect(){
        $this->servername = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->dbname = 'doodle_db';
 
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        return $conn;
    }
}
?>
