<?php

function view($name, $data = [], $error = []) {
    extract($data);
    extract($error);

    return require "MVC/views/{$name}.php";
  }

  function view_sub($name, $data = [], $error = []) {
    extract($data);
    extract($error);

    return require "MVC/views/subs/{$name}.php";
  }

function uri() {
    return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
  }

function method() {
    return $_SERVER['REQUEST_METHOD'];
  }

  

  function path_name() {

    $live = false;

    if ($live) {
      return array(
        "/var/www/MVC/views/origin.php",   
        "/var/www/MVC/views/subs"

        
        
      );
    } else {
      return array(
        "/Users/*name*/desktop/anonForum/MVC/views/origin.php",   
        "/Users/*name*/desktop/anonForum/MVC/views/subs"
      );
    }

  }