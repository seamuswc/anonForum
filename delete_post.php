#!/usr/bin/env php
<?php
require __DIR__ . '/vendor/autoload.php';

use ooshi\core\DB;
$db = new DB;
$db = $db->getConnection();

//delete post by ID

//Return IP address
echo "Please enter the Integer of the Post: It will be deleted and print all corresponding post information (enter below):\n";
$id = fread(STDIN, 80); // Read up to 80 characters or a newline





$file = $db->CommandSelect($id);

chmod("public/".$file['file'], 0755); //Change the file permissions if allowed
unlink("public/".$file['file']); //remove the file

$db->CommandDelete($file['id']);

echo var_dump($file);




?>