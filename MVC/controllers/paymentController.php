<?php


  class paymentController {

    public function check() {

      if(session_status() == PHP_SESSION_NONE) {
        session_start();
      }

      $address = $_POST['address'];

      $blockcypher = new BlockCypher($address);
      $received = $blockcypher->checkPayment();

      $_SESSION["paid"] = $received;

      if ( (isset($_SESSION["paid"])) && ($_SESSION["paid"] == true) ) {
        return view('paid');
      } else {
        $error = true;
        return view('index', compact('address'), compact('error') );
      }

    }
  }
