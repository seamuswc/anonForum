<?php

namespace ooshi\core;

use ooshi\core\database\Queries;
use ooshi\core\database\Connection;

class DB
{
    public $db;

    function __construct() {
        $config = require 'config.php';
        $this->db = new Queries(
            Connection::connect($config['database'])
        );
    }

    public function getConnection() {
        return $this->db;
    }


}


