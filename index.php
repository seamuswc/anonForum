<?php

//set server session time if you want here. Currently lasts until browser closes.

require 'vendor/autoload.php';

use stream\core\Router;
use stream\core\DB;

  $db = new DB;
  $db = $db->getConnection();

  if ( $db->userExists() ) {
    $db=NULL;
    Router::load('core/routes.php')
  		->direct(uri(), method());
  } else if ( !$db->userExists() && (method()=="POST") && (uri()=="register") ) {
    Router::load('core/routes.php')
  	  ->direct(uri(), method());
  } else {
      return view('register');
  }
  
