<?php

namespace stream\core\database;

use PDO;
use PDOException;

class Queries
{
 
    protected $pdo;

   
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getKeys() {
        $statement = $this->pdo->prepare("use stream");
        $statement->execute();
        $statement = $this->pdo->prepare("select * from users LIMIT 1");
        $statement->execute();

        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        $public = $results[0]['public'];
        $secret = $results[0]['secret'];
        $keys = array($public, $secret);

        return $keys;
    }

    public function setup(){
        try {

            $statement = $this->pdo->prepare("CREATE DATABASE IF NOT EXISTS stream");
            $statement->execute();

            $statement = $this->pdo->prepare("use stream");
            $statement->execute();
         
            $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            username VARCHAR(30) NOT NULL,
            password VARCHAR(30) NOT NULL,
            public VARCHAR(30) NOT NULL,
            secret VARCHAR(30) NOT NULL
            )";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();

        } catch(PDOException $e) {
            die($e);
        }
    }

    public function userExists(){
    $bool = false;
       try { 
            $statement = $this->pdo->prepare("use stream");
            $statement->execute();
            $statement = $this->pdo->prepare("select * from users");
            $statement->execute();
       } catch (PDOException $e) {
            return false;
       }
      
        $count = $statement->rowCount();

        if ($count > 0) {
            $bool = true;
        }
        return $bool;
    }

    public function userRegistered($data){
        $statement = $this->pdo->prepare("use stream");
        $statement->execute();
        $statement = $this->pdo->prepare("select * from users LIMIT 1");
        $statement->execute();

        $results=$statement->fetchAll(PDO::FETCH_ASSOC);
        $username = $results[0]['username'];
        $password = $results[0]['password'];
        $public = $results[0]['public'];
        $secret = $results[0]['secret'];

        if ( ($username == $data['username']) && ($password == $data['password']) ) {
            return true;
        } else {
            return false;
        }
    }
   
    
    public function insert($table, $parameters)
    {

        //'insert into %s (%s, %s) values (:%s, :s)',
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $table,
            implode(', ', array_keys($parameters)),
            ':' . implode(', :', array_keys($parameters))
        );

        try {
            $statement = $this->pdo->prepare($sql);

            $statement->execute($parameters);
        } catch (\Exception $e) {
            die($e);
        }
    }

}
