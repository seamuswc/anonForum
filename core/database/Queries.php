<?php
//need to sql inject protect

namespace anonForum\core\database;

use PDO;
use PDOException;

class Queries
{
 
    protected $pdo;
    protected $db_name = "use u308335766_anon";

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    protected function db_prepare() {
        $statement = $this->pdo->prepare($this->db_name);
        $statement->execute();
    }

    public function setup() {
       
        try {

            $statement = $this->pdo->prepare("CREATE DATABASE IF NOT EXISTS u308335766_anon");
            $statement->execute();

            $this->db_prepare();
         
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
            body TEXT NOT NULL,
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
        $this->db_prepare();
        
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
        $this->db_prepare();

        
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
        $this->db_prepare();

        
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
            
        $this->db_prepare();


        
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
        $this->db_prepare();

        
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

        $this->db_prepare();

        
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

        $this->db_prepare();

        
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
        $this->db_prepare();

        
        
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
        $this->db_prepare();

        
        
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

        $this->db_prepare();

        
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

        $this->db_prepare();

        
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
