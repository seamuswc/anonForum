<?php

namespace anonForum\core\database;

use PDO;
use PDOException;

class Connection
{
    public static function connect($config)
    {
        try {
            return new PDO(
                $config['connection'],
                $config['username'],
                $config['password'],
                $config['options']
            );
        } catch (PDOException $e) {
            die($e->getMessage());
            //die('ugh');
        }
    }
}

