<?php require('partials/header.php'); ?>

 <div class="box">

    <div class="ui dimmer">
      <div class="ui text massive text loader"> Uploading </div>
    </div>

<br><br><br>

<div class="ui grid center aligned">

<form class="ui form" method="POST" action="/upload" enctype="multipart/form-data">
  <div class="two fields">
    <div class="eight wide field">
      <label> Trailer Upload </label>
      <input type="file" name="trailer" placeholder="Trailer">
    </div>
    <div class="eight wide field">
      <label>Movie Upload</label>
      <input type="file" name="movie" placeholder="Movie">
    </div>
    <!--<div class="four wide field">
      <label>Price</label>
      <input type="text" name="price" placeholder="Price">
    </div>-->
  </div>

  <div class="ui four column grid center aligned">
  <div class="two column row">
    <div class="column"> <div class="ui submit button inverted green" >Submit</div> </div>
    <div class="column"> <a href="/logout" class="item"><div class="ui button inverted red">LogOut</div></a></div>
  </div>
  </div>

    <div class="ui error message">
    </div>

</form>
</div>

<br><br><br>

  <?php
    if( $failure == true ) {
      echo "<div class='ui red message'><center>Files did not upload. Must be MP4. Trailer under 1G / Movie under 5G</center></div>";
    }
    if( $success == true ) {
      echo "<div class='ui green message'><center>Successfully Uploaded your files</center></div>";
    } else {
      echo "<div class='ui blue message'><center>
      Files must be MP4. 
      Trailer under 1G, Movie under 5G. 
      New uploads will automatically overwrite older files.
      </center></div>";
    }        
  ?>

</div>

<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<script src="vendor/semantic/ui/dist/semantic.min.js"></script>


<script>
  
      $('.ui.form')
        .form({
          fields: {
            trailer: {
              identifier  : 'trailer',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please select a Trailer'
                }
              ]
            },
            movie: {
              identifier  : 'movie',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please select a Movie'
                }            
              ]
            }
          },
              onSuccess: function(event, fields) {
              dim();
              }
        })
      ;
    
  

  function dim() {
  $('.box').dimmer('show');
  }


  </script>





</body>
</html>



