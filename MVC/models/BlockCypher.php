<?php

namespace stream\MVC\models;

class BlockCypher {

  protected $address;

  function __construct($address) {
    $this->address = $address;
  }

  public function checkPayment() {

    sleep(3);

    try {
      $json=file_get_contents("https://api.blockcypher.com/v1/btc/main/addrs/$this->address");
    } catch (\Exception $e) {
      return false;
    }

    $json=json_decode($json);
    $received = (float) ($json->unconfirmed_balance + $json->balance);

    if ( $received > 0.0000000000 ) {
      return true;
    } else {
      return false;
    }

  }




}
