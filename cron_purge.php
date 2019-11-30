#!/usr/bin/env php
<?php

require 'core/DB.php';

use anonForum\core\DB;
$db = new DB;
$db = $db->getConnection();



    $dir = path_name();
	$db->clean();
	array_map('unlink', glob($dir[1]."/*.*"));




    echo 'purged';






?>