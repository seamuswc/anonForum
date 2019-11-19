



<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>anonForum</title>
        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
        <script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>

      <style>
        .ui.comments {
          max-width: none !important;
        }


      </style>

       <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                text-align: center;
              }

             
             .space_top {
              margin-top: .15em !important;
             }
              
             
        </style>

    </head>
    <body>
      
     



<br>
      <div class="flex-center position-ref">
            <div class="content">
                <div class="links">
                  <a href="/">Home</a>

                </div>
            </div>
      </div>

<br>
<br>

<div class="ui grid center aligned">
<form class="ui form" method="POST" action="/upload" enctype="multipart/form-data">

    <input type="hidden" name="uri" value=<?php echo uri(); ?> >
     
     <div class="field">
      <label>Text</label>
      <div class="ui action input">
        <textarea rows="5" cols="50" name="body"></textarea>
        <button class="ui submit button inverted green" type="submit">Submit</button>
      </div>
    </div>

    

</form>
</div>



<br>
<br>
<br>

  <?php
  foreach($posts as $post) {

    if ($post['type'] == 'text') {
      echo "
        <div class='centered'>" .$post['id'] . "  ". $post['created']."</div>
        <div class='ui raised segment'>
          <p>". $post['body'] ."</p>
        </div>
        ";
    }
  
  } //foreach end
    
 ?>




<script>

   
  $('.ui.form')
      .form({
        fields: {
        file : 'empty'      }
    })
  ;
  
    
  </script>


</body>
</html>
