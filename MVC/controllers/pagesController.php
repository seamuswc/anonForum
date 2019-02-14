<?php


class pagesController {

private $pub_key = "7WdedTmoo16m0Dzt7yko";
private $priv_key = "3ry3bCxFpA3jQS853hSiQ2oBz9ZK";

  public function index() {

    if(session_status() == PHP_SESSION_NONE) {
      session_start();
    }

    if ( (!isset($_SESSION["paid"])) || ($_SESSION["paid"] != true) ) {
      $gemini = new Gemini($this->pub_key, $this->priv_key);
      $address = $gemini->createAddress();
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


}
