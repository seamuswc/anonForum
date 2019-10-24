<?php


require 'vendor/autoload.php';

use ooshi\core\DB;


  $db = new DB;
  $db = $db->getConnection();
  $db->setup();


  
