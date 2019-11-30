<?php

require 'core/DB.php';
require 'core/Helpers.php';


use anonForum\core\DB;

  

  $db = new DB;
  $db = $db->getConnection();

  $dir = path_name();
	$db->clean();
	array_map('unlink', glob($dir[1]."/*.*"));

  $db->setup();
    
  $bool1 = chmod("MVC/views/origin.php", 0755);  
  $bool2 = chmod("MVC/views/subs", 0755);  

    if ($bool1 && $bool2) {
        echo "true";
    } else {
        echo "false";
    }

  
