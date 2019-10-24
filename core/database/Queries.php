<?php
//need to sql inject protect

namespace ooshi\core\database;

use PDO;
use PDOException;

class Queries
{
 
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function setup() {
       
        try {

            $statement = $this->pdo->prepare("CREATE DATABASE IF NOT EXISTS anon");
            $statement->execute();

            $statement = $this->pdo->prepare("use anon");
            $statement->execute();
         
            $sql = "CREATE TABLE IF NOT EXISTS channels (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            channel VARCHAR(25) NOT NULL,
            count int(11) NOT NULL,
            created VARCHAR(50) NOT NULL
            )";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();

            $sql = "CREATE TABLE IF NOT EXISTS ips (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            ip VARCHAR(50) NOT NULL,
            created VARCHAR(50) NOT NULL
            )";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();

            $sql = "CREATE TABLE IF NOT EXISTS posts (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
            channel VARCHAR(25) NOT NULL,
            file VARCHAR(100) NOT NULL,
            ip VARCHAR(50) NOT NULL,
            type VARCHAR(10) NOT NULL,
            created VARCHAR(50) NOT NULL
            )";
            $statement = $this->pdo->prepare($sql);
            $statement->execute();


        } catch(PDOException $e) {
            die($e);
        }
    }

    
   
    
    public function insert($table, $parameters)
    {
        $statement = $this->pdo->prepare("use anon");
        $statement->execute();
        
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

    public function selectAll($table)
    {
        $statement = $this->pdo->prepare("use anon");
        $statement->execute();
        
        $sql = "SELECT * FROM $table";
        

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (\Exception $e) {
            die($e);
        }

        return($statement->fetchAll(PDO::FETCH_ASSOC));

    }


    public function selectWhere($table, $column, $value, $order = NULL)
    {
        $statement = $this->pdo->prepare("use anon");
        $statement->execute();
        
        if ($order == NULL) {
            $sql = "SELECT * FROM $table WHERE $column = '$value'";
        } else {
            $sql = "SELECT * FROM $table WHERE $column = '$value' ORDER BY id DESC";

        }

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (\Exception $e) {
            die($e);
        }

        return($statement->fetchAll(PDO::FETCH_ASSOC));
    }

    public function selectCount($table, $column, $value) {
            
        $statement = $this->pdo->prepare("use anon");
        $statement->execute();

        
        $sql = "SELECT COUNT($column) FROM $table WHERE $column = '$value'";
        
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (\Exception $e) {
            die($e);
        }

        return($statement->fetchColumn());
    }

    public function selectFirst($table, $column, $value, $order = NULL)
    {
        $statement = $this->pdo->prepare("use anon");
        $statement->execute();
        
        if ($order == NULL) {
            $sql = "SELECT * FROM $table WHERE $column = '$value' LIMIT 1";
        } else {
            $sql = "SELECT * FROM $table WHERE $column = '$value' ORDER BY id ASC LIMIT 1";
        }
        


        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (\Exception $e) {
            die($e);
        }

        return($statement->fetch(PDO::FETCH_ASSOC));
    }

    public function delete($table, $id) {

        $statement = $this->pdo->prepare("use anon");
        $statement->execute();
        
        $sql = "DELETE FROM $table WHERE id = '$id'";

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (\Exception $e) {
            die($e);
        }

        //return($statement->fetchAll(PDO::FETCH_ASSOC));
    }
    

    //Commands
    public function CommandDelete($id) {

        $statement = $this->pdo->prepare("use anon");
        $statement->execute();
        
        $sql = "DELETE FROM posts WHERE id = '$id'";

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (\Exception $e) {
            die($e);
        }

        

        //return($statement->fetchAll(PDO::FETCH_ASSOC));
    }

    public function CommandSelect($id)
    {
        $statement = $this->pdo->prepare("use anon");
        $statement->execute();
        
        
        $sql = "SELECT * FROM posts WHERE id = '$id'";
        

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (\Exception $e) {
            die($e);
        }

        return($statement->fetch(PDO::FETCH_ASSOC));
    }

    //----

    public function CommandSelectSub($sub)
    {
        $statement = $this->pdo->prepare("use anon");
        $statement->execute();
        
        
        $sql = "SELECT * FROM posts WHERE channel = '$sub'";
        

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (\Exception $e) {
            die($e);
        }

        return($statement->fetchAll(PDO::FETCH_ASSOC));
    }

    public function CommandDeleteSub($sub) {

        $statement = $this->pdo->prepare("use anon");
        $statement->execute();
        
        $sql = "DELETE FROM posts WHERE channel = '$sub'";

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (\Exception $e) {
            die($e);
        }

        $sql = "DELETE FROM channels WHERE channel = '$sub'";

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (\Exception $e) {
            die($e);
        }

        

        //return($statement->fetchAll(PDO::FETCH_ASSOC));
    }

    public function clean() {

        $statement = $this->pdo->prepare("use anon");
        $statement->execute();
        
        $sql = "DELETE FROM posts";

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (\Exception $e) {
            die($e);
        }

        $sql = "DELETE FROM channels";

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (\Exception $e) {
            die($e);
        }

        $sql = "DELETE FROM ips";

        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute();
        } catch (\Exception $e) {
            die($e);
        }

        

        //return($statement->fetchAll(PDO::FETCH_ASSOC));
    }
   

}
