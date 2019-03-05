<?php

namespace stream\MVC\controllers;

use stream\core\DB;
use stream\MVC\controllers\pagesController;
use stream\MVC\models\Upload;


class adminController {

  public function login() {

    $data = array(
      "username" => $_POST['username'],
      "password" => $_POST['password']
    );
      
    $db = new DB;
    $db = $db->getConnection();
    $bool = $db->userRegistered($data);

    if ($bool == true) {
      if(session_status() == PHP_SESSION_NONE) {
        session_start();
      }
      $_SESSION["log"] = true;

      $manage = new pagesController;
      return $manage->manage();
    
    } else {
      return view('login');
    }
    
  }

  public function register() {
    //creates all MYSQL Tables, Etc...
    $db = new DB;
    $db = $db->getConnection();
    $db->setup();
    
    //encrypt eventually
    $data = array(
      "username" => $_POST['username'],
      "password" => $_POST['password'],
      "public" => $_POST['public'],
      "secret" => $_POST['secret'],
    );
    $db->insert('users', $data);

    //log user on and to manage
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
      }

    $_SESSION["log"] = true;
    $db = NULL;

    $manage = new pagesController;
    return $manage->manage();  
  }

  
  public function logout() {
    
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
      }
      $_SESSION["log"] = false;

      $index = new pagesController;
      return $index->index();
    
  }

  public function upload() {
    $upload = new Upload;
    $upload = $upload->upload();
    if ($upload == true) {
      $success = true;
      $failure = false;
      return view('manage', compact('success'), compact('failure') );  
    } else {
      //sleep(1);
      $success = false;
      $failure = true;
      return view('manage', compact('success'), compact('failure') );  
    }
  }

}
