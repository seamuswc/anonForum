<?php

require 'core/Router.php';
require 'core/Helpers.php';


use anonForum\core\Router;

    Router::load('core/routes.php')
      ->direct(uri(), method());


  
  