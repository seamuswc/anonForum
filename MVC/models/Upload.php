<?php

namespace stream\MVC\models;



class Upload {

  public function upload() {


    $extension = pathinfo($_FILES["trailer"]["name"], PATHINFO_EXTENSION);
    
    if ( ($_FILES["trailer"]["size"] < 1000000000)  //1gig
  	&& ($extension == "mp4") )
  	{
      if(file_exists("public/movies/trailer". '.' . $extension)) {
        chmod("public/movies/trailer". '.' . $extension, 0755); //Change the file permissions if allowed
        unlink("public/movies/trailer". '.' . $extension); //remove the file
      }
      try {
        move_uploaded_file( $_FILES["trailer"]["tmp_name"],
        "public/movies/" . 'trailer' . '.' . $extension);
        return true; 
      } catch(Exception $e) {
        return false;
      }
    } else {
        return false;
    }

    //-------------------------------------------------------------------//
    
    $extension = pathinfo($_FILES["movie"]["name"], PATHINFO_EXTENSION);
    
    if ( ($_FILES["movie"]["size"] < 5000000000)  //5gig
    && ($extension == "mp4") )
    {
      if(file_exists("public/movies/movie". '.' . $extension)) {
        chmod("public/movies/movie". '.' . $extension, 0755); //Change the file permissions if allowed
        unlink("public/movies/movie". '.' . $extension); //remove the file
      }
      try {
        move_uploaded_file( $_FILES["movie"]["tmp_name"],
        "public/movies/" . 'movie' . '.' . $extension);
        return true; 
      } catch(Exception $e) {
        return false;
      }
    } else {
        return false;
    }

  
  }
}


