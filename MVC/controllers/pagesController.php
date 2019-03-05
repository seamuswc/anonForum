<?php

namespace stream\MVC\controllers;

use stream\MVC\models\Gemini;
use stream\core\DB;


class pagesController {

  public function index() {

    if(session_status() == PHP_SESSION_NONE) {
      session_start();
    }

    if ( (!isset($_SESSION["paid"])) || ($_SESSION["paid"] != true) ) {
      $gemini = new Gemini();
      $address = $gemini->createAddress();

      //Try it again, sometimes in China it needs two attempts
      if ($address == NULL || $address == "") {
        $address = $gemini->createAddress();
      }

      return view('index', compact('address') );
    } else {
      return $this->paid();
    }

  }

  public function paid() {
    if(session_status() == PHP_SESSION_NONE) {
      session_start();
    }
    if ( (isset($_SESSION["paid"])) && ($_SESSION["paid"] == true) ) {
      return view('paid');
    } else {
      return $this->index();
    }
  }

  public function loginForm() {
    if(session_status() == PHP_SESSION_NONE) {
        session_start();
      }

      //check if userlogged in
      if ( (isset($_SESSION["log"])) && ($_SESSION["log"] == true) ) {
        return view('manage');
      } else {
        return view('login');
      }
  }

  public function registerForm() {
    $db = new DB;
    $db = $db->getConnection();
    $bool = $db->userExists();
    $db = NULL;
    if ($bool) {
      return $this->index();
    }
    return view('register');
  }

  public function manage() {

    if(session_status() == PHP_SESSION_NONE) {
        session_start();
      }

      //check if userlogged in
      if ( (isset($_SESSION["log"])) && ($_SESSION["log"] == true) ) {
        return view('manage');
      } else {
        $index = new pagesController;
        return $this->index();
      }
  }


}
