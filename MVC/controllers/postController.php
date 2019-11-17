<?php

namespace ooshi\MVC\controllers;

use ooshi\core\DB;
use ooshi\MVC\controllers\channelController;
use ooshi\MVC\models\Upload;
use Carbon\Carbon;


class postController {

  public $db;

  public function __construct() {
    $db = new DB;
    $this->db = $db->getConnection();
  }


  public function index() {
      $channels = $this->db->selectAll('channels');
      return view('channels', compact('channels') );
  }
  
  public function ip_check() {
        $ip = $_SERVER['REMOTE_ADDR'];
        $latest_use = $this->db->selectWhere('ips', 'ip', $ip, true);
        #if ip never used before
        if ( !$latest_use ) {
            return false;
        } 
        $dateTime = new Carbon($latest_use[0]['created']);
        $diff = $dateTime->diffInMinutes(Carbon::now());
        if ($diff > 60) {
          return false;
        }
        return true;   
  } 

  public function check_ten($uri) {
        $count = $this->db->selectCount('posts', 'channel', $uri); 
        if ($count >= 10) {
            $tenth = $this->db->selectFirst('posts', 'channel', $uri, true);
            $deleted = $this->db->delete('posts', $tenth['id']);
        }  
  } 

  public function create() {
      
      $uri = $_POST['uri'];
      $url_array = explode("/", $uri);
      $uri = end($url_array);

      
      if ($this->ip_check()) {
        $controller = new channelController;
        return $controller->go($uri);   
      }

      $this->check_ten($uri);

        $channel = $uri;
        $body = $_POST['body'];
        $ip = $_SERVER['REMOTE_ADDR'];
        $type = 'text';

        $data = array(
            "channel" => $channel,
            "body" => $body,
            "ip" => $ip,
            "type" => $type,
            "created" => date("Y-m-d H:i:s")
          );

        $this->db->insert('posts', $data);
        
        $data = array(
            "ip" => $ip,
            "created" => date("Y-m-d H:i:s")
          );
        $this->db->insert('ips', $data);

        $controller = new channelController;
        return $controller->go($uri);      
  }


}
