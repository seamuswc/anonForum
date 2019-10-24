#!/usr/bin/env php
<?php
require __DIR__ . '/vendor/autoload.php';

use ooshi\core\DB;
$db = new DB;
$db = $db->getConnection();

//delete post by ID

//Return IP address
echo "Are you sure you want to delete all subs & posts?\n";
$sub = fread(STDIN, 80); // Read up to 80 characters or a newline
$sub = trim($sub);

if ($sub =='y' || $sub =='Y' || $sub =='yes' || $sub =='YES' || $sub =='Yes') {
	$files = $db->clean();
}



/*foreach ($files as $file) {
	chmod("public/".$file['file'], 0755); //Change the file permissions if allowed
	unlink("public/".$file['file']); //remove the file
}

$db->CommandDeleteSub($sub);

echo var_dump($files);*/




?>