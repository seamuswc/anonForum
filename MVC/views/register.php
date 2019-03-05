


<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>LighteningMedia</title>

        <!-- Styles -->
        <link rel="stylesheet" href="vendor/semantic/ui/dist/semantic.min.css">
        <link rel="stylesheet" href="public/css/style.css">

        <style type="text/css">
    body {
      background-color: #DADADA;
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }
  </style>
  

    </head>
    <body>


  

<div class="ui middle aligned center aligned grid">
  <div class="column">
    <h2 class="ui red header">
      <div class="content">
        Register your new account.
      </div>
    </h2>
    <form class="ui large form" method="POST" action="/register">
      <div class="ui stacked segment">
        <div class="field">
          <div class="ui left icon input">
            <i class="user icon"></i>
            <input type="text" name="username" placeholder="Username">
          </div>
        </div>

        <div class="field">
          <div class="ui left icon input">
            <i class="lock icon"></i>
            <input type="password" name="password" placeholder="Password">
          </div>
        </div>

        <div class="field">
          <div class="ui left icon input">
            <i class="key icon"></i>
            <input type="text" name="public" placeholder="Gemini Public Key">
          </div>
        </div>

        <div class="field">
          <div class="ui left icon input">
            <i class="key icon"></i>
            <input type="text" name="secret" placeholder="Gemini Secret Key">
          </div>
        </div>


        <div class="ui fluid large red submit button">Register</div>
      </div>

      <div class="ui error message"></div>

    </form>

    
  </div>
</div>

<script
src="https://code.jquery.com/jquery-3.3.1.min.js"
integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
crossorigin="anonymous"></script>
<script src="vendor/semantic/ui/dist/semantic.min.js"></script>


<script>
  $(document)
    .ready(function() {
      $('.ui.form')
        .form({
          fields: {
            username: {
              identifier  : 'username',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your username'
                },
                {
                  type   : 'length[6]',
                  prompt : 'Your username must be at least 6 characters'
                }
              ]
            },
            password: {
              identifier  : 'password',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your password'
                },
                {
                  type   : 'length[6]',
                  prompt : 'Your password must be at least 6 characters'
                }
              ]
            },

            key: {
              identifier  : 'public',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your public gemini key'
                }
              ]
            },

            secret: {
              identifier  : 'secret',
              rules: [
                {
                  type   : 'empty',
                  prompt : 'Please enter your secret gemini key'
                }
              ]
            },

          }
        })
      ;
    })
  ;
  </script>



</body>
</html>

