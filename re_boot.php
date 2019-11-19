<?php


require 'vendor/autoload.php';

use anonForum\core\DB;


  $db = new DB;
  $db = $db->getConnection();
  $db->setup();


  
