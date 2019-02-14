<?php require('partials/header.php'); ?>


    <div class="box">

    <div class="ui dimmer">
      <div class="ui text massive text loader"> Checking Payment </div>
    </div>

        <div class="top">

          <div class="ui centered card mp0">
            <div class="content">

              <div class="description center aligned">

                <?php
                if( $error == true ) {
                  echo "<span class='error'>Payment not Recieved, Try Again <span>";
                } else {
                  echo "Send any amount of BTC to begin streaming.";
                  echo "<br>";
                  echo "DO NOT send using an exhange, use a wallet for fast verification";
                }
                ?>

              </div>

            </div>

<!--Add a semantic Fade on form submit-->
            <div class="extra content center aligned">
                <form method="POST" action="/checkPayment">
                  <input type="hidden" name="address" value="<?php echo $address ?>">
                  <button onclick="dim()" type="submit" class="ui green button">Payment Sent</button>
                </form>
              </div>

              <div class="extra content center aligned">
                <div class="header center aligned wrap">
                  <?php echo $address ?>
                </div>
            </div>
        </div>
      </div>

      <span class="spacer5px"></span>

        <div class="bottom">
          <video preload="auto" src="public/trailers/trailer.mp4" width="100%" height="100%" controls>
          </video>
        </div>

    </div> <!--box-->


    <?php require('partials/footer.php'); ?>
