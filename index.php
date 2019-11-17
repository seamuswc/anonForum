<?php

require 'vendor/autoload.php';
use ooshi\core\Router;

    Router::load('core/routes.php')
      ->direct(uri(), method());


  
