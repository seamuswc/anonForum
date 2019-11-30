#!/usr/bin/env php
<?php
require 'core/DB.php';

use anonForum\core\DB;
$db = new DB;
$db = $db->getConnection();


echo "Are you sure you want to delete all subs & posts?\n";
$sub = fread(STDIN, 80); // Read up to 80 characters or a newline
$sub = trim($sub);

$dir = path_name();
		
if ($sub =='y' || $sub =='Y' || $sub =='yes' || $sub =='YES' || $sub =='Yes') {
	$db->clean();
	array_map('unlink', glob($dir[1]."/*.*"));
}

?>