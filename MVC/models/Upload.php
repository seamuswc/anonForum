<?php

namespace ooshi\MVC\models;



class Upload {

  public function upload($name) {

     
      if(file_exists("public/".$name)) {
        chmod("public/".$name, 0755); //Change the file permissions if allowed
        unlink("public/".$name); //remove the file
      }
      try {
        move_uploaded_file( $_FILES["file"]["tmp_name"],
        "public/".$name);
  
        return true; 
      } catch(Exception $e) {
        return false;
      }
    
    } 

    

  }




