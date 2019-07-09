<?php

class DataBase 
{
    protected $servername;
    protected $username;
    protected $database;
    protected $password;

    protected function connectBase()
    {
        $this->servername = "localhost";
        $this->username = "root";
        $this->database = "mybase";
        $this->password = "";

        try {
            $conn = new PDO("mysql:host=".$this->servername.";dbname=".$this->database.";", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }        
    }

    public function createTable()
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
                id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
                firstname VARCHAR(32) NOT NULL,
                lastname VARCHAR(32) NOT NULL,
                email VARCHAR(64)
                )";

        try {
            $this->connectBase()->exec($sql);
        }
        catch(PDOException $e) {
            echo "Error " . $e;
        }
    }
    
    public function isValidEmail($email)
    {
        $sql = $this->connectBase()->prepare("SELECT * FROM users WHERE email=?");
     
        $sql->execute([$email]); 
     
        $user = $sql->fetch();

        if($user) {
            return false;
        }
        else {
            return true;
        }
    }

    public function addUser($firstName, $lastName, $email)
    {
        $sql = "INSERT INTO users (firstname, lastname, email) VALUES (:firstname, :lastname, :email)";
        
        $result = $this->connectBase()->prepare($sql);

        $exec = $result->execute(array(":firstname"=> $firstName, ":lastname" => $lastName, ":email" => $email));
    }
}