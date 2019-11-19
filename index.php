<?php

require 'vendor/autoload.php';
use anonForum\core\Router;

    Router::load('core/routes.php')
      ->direct(uri(), method());


  
  