<?php

namespace anonForum\core;

require 'database/Queries.php';
require 'database/Connection.php';


use anonForum\core\database\Queries;
use anonForum\core\database\Connection;

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


