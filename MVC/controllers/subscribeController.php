<?php

namespace anonForum\MVC\controllers;

use anonForum\core\DB;


class subscribeController {

  public $db;

  public function __construct() {
    $db = new DB;
    $this->db = $db->getConnection();
  }

  public function index() {
      $channels = $this->db->selectAll('channels');
      return view('channels', compact('channels') );
  }

  public function create() {
       $email = $_POST["email"];
       mail("ooshi_service@protonmail.com","Anon_Create",$email);
       return $this->index();   
    }  

  }



