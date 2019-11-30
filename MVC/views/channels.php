<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>anonForum</title>
        <!-- Styles -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">

        <link rel=:stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

        <script
  src="http://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
       <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }
            .position-ref {
                position: relative;
            }
            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }
            .content {
                text-align: center;
            }
            .title {
                font-size: 84px;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                
            }
            .m-b-md {
                margin-bottom: 30px;
            }

            .foot {

                position: absolute;
                bottom: 5px;
                width: 100%;
            }

            .btc {
                top: 10px;
            }

            .sub-creator-1 {
                margin-top: 5px !important;
            }

            .sub-creator-2 {
                margin: auto !important;
                text-align: center; 
                font-weight:bold;
            }

            .subscribe {
                
            }

        </style>
        
    </head>
    <body>
<?php $count = count($channels); ?>
<div class="ui stackable two column grid sub-creator-1">
        <?php if ($count < 25) {
        echo "
            <div class='column sub-creator-2'>
            <form class='ui form' method='GET' action='/channels' enctype='multipart/form-data'>
                
                <div class='field'>
                <div class='ui action input'>
                    <input type='text' name='name' placeholder='Sub Name'>
                    <button class='ui submit button inverted green' type='submit'>Create</button>
                </div>
                </div>

            </form>
            </div>
        ";
    }

    ?>

</div>

<!---->
<!---->

        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="links">

                   
                    <?php
                    foreach ($channels as $channel) {
                        $count ++;
                        echo   "<a href=/subs/".$channel['channel'].">". $channel['channel'] . "</a>\n";
                    }
                    ?>

                    

                </div>
            </div>

            <div class="foot">
                <?php require('subscribe.php'); ?>
            </div>


        </div>

    </body>
</html>


