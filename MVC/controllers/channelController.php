<?php

namespace ooshi\MVC\controllers;

use ooshi\core\DB;


class channelController {

  public $db;

  public function __construct() {
    $db = new DB;
    $this->db = $db->getConnection();
  }

  public function index() {
      $channels = $this->db->selectAll('channels');
      return view('channels', compact('channels') );
  }

  public function rules() {
      return view('rules');
  }

  public function go($uri) {
      header("Location: /$uri");
      $posts = $this->db->selectWhere('posts', 'channel', $uri, true);
      return view_sub($uri, compact('posts'));
  }

  public function show() {
    
    $channels = $this->db->selectAll('channels');
    
    $url_array = explode("/", uri());
    $uri = end($url_array);
    foreach ($channels as $channel) {
      if ($channel['channel'] == $uri ) {
        $posts = $this->db->selectWhere('posts', 'channel', $channel['channel'], true);
        return view_sub($channel['channel'], compact('posts')); 
      }
    }

    return $this->index();
  }

  public function create() {
       $name = $_GET["name"];
       $exists = $this->db->selectWhere('channels', 'channel', $name);
        
        if (strlen(trim($name)) != 0 && (!$exists) )  {
          $data = array(
           "channel" => $name,
            "count" => 0,
            "created" => date("Y-m-d H:i:s")
          );


        $this->db->insert('channels', $data);
            
         $src_dest = path_name();
         $src = $src_dest[0];
         $dest = $src_dest[1]."/$name.php";
        copy($src, $dest);  
        return $this->index();   
    }  

  }


}
