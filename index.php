<?php

//set server session time

require 'core/Helpers.php';
require 'vendor/autoload.php';

Router::load('core/routes.php')
  ->direct(uri(), method());

?>
