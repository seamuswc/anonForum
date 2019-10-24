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
  
  public function get_type($ext) {

    switch ($ext) {
      case 'jpg':
        $type = 'image';
        break;
      case 'jpeg':
        $type = 'image';
        break;
      case 'png':
        $type = 'image';
        break; 
      default:
        $type = false;
        break;
    }
    return $type;

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
        //selectCount($table, $column, $value) {
        $count = $this->db->selectCount('posts', 'channel', $uri);
        
        if ($count >= 5) {

            $tenth = $this->db->selectFirst('posts', 'channel', $uri, true);
            
            //delete storage file
            $name = $tenth['file'];
            if(file_exists("public/".$name)) {
              chmod("public/".$name, 0755); //Change the file permissions if allowed
              unlink("public/".$name); //remove the file
            }

            //delete the DB
            $deleted = $this->db->delete('posts', $tenth['id']);
        }  
  } 

  public function create() {
      $uri = $_POST['uri'];

      if ($this->ip_check()) {
        $controller = new channelController;
        return $controller->go($uri);   
      }

      $this->check_ten($uri);

      //validation
      $ext = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
      $pass_ext = (($ext == 'jpg') || ($ext == 'jpeg') || ($ext == 'png'));
      
      $size = $_FILES['file']['size'];
      $pass_size = ($size < 5000000);


      $name = pathinfo($_FILES["file"]["name"], PATHINFO_BASENAME);
      $name = $name.date("Y-m-d H:i:s").rand(0,1000);
      $name = str_replace(array(".", " "), "", $name);
      $name = trim($name.".".$ext);


      $upload = false;
      if ($pass_size && $pass_ext) {
        $upload = new Upload;
        $upload = $upload->upload($name);
      }

     

      if ($upload) {

        $channel = $_POST['uri'];
        $file = $name;
        $ip = $_SERVER['REMOTE_ADDR'];
        $type = $this->get_type($ext);


        $data = array(
            "channel" => $channel,
            "file" => $name,
            "ip" => $ip,
            "type" => $this->get_type($ext),
            "created" => date("Y-m-d H:i:s")
          );

        $this->db->insert('posts', $data);
        
        $data = array(
            "ip" => $ip,
            "created" => date("Y-m-d H:i:s")
          );
        $this->db->insert('ips', $data);

      } 
 
        $controller = new channelController;
        return $controller->go($uri);      
  }


}
