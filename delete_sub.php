#!/usr/bin/env php
<?php
require __DIR__ . '/vendor/autoload.php';

use ooshi\core\DB;
$db = new DB;
$db = $db->getConnection();

//delete post by ID

//Return IP address
echo "Please enter the sub to delete: it will print all info and delete all posts on sub\n";
$sub = fread(STDIN, 80); // Read up to 80 characters or a newline
$sub = trim($sub);

$files = $db->CommandSelectSub($sub);


foreach ($files as $file) {
	chmod("public/".$file['file'], 0755); //Change the file permissions if allowed
	unlink("public/".$file['file']); //remove the file
}

$db->CommandDeleteSub($sub);

echo var_dump($files);




?>