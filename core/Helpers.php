<?php

function view($name, $data = [], $error = []) {
    extract($data);
    extract($error);

    return require "MVC/views/{$name}.php";
  }

function uri() {
    return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
  }

function method() {
    return $_SERVER['REQUEST_METHOD'];
  }
