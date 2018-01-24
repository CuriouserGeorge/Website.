<?php
  require "twitteroauth/autoload.php";

  use Abraham\TwitterOAuth\TwitterOAuth;

  $consumer_key = "";
  $consumer_secret = "c";
  $access_token = "";
  $access_token_secret = "";
    
  $connection = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);
  $content = $connection->get("account/verify_credentials");
  
  $statuses = $connection->get("statuses/home_timeline", ["count" => 200, "exclude_replies" => true]);



 
  echo '<script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="twitter.png">

    <title>Twitter</title>

    <!-- Bootstrap core CSS -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">


    <!-- Custom styles for this template -->
    <link href="starter-template.css" rel="stylesheet">
  </head>

  <body>

    <nav class="navbar navbar-dark bg-primary">
      <a class="navbar-brand" href="#">
        <img src="twitter.png" width="30" height="30" class="d-inline-block align-top" alt="">
        Twitter
      </a>
    </nav>

    <div class="container">
      <div class="row justify-content-center">
        <?php
            foreach ($statuses as $status){
              if($status->retweet_count > 200){
                $id = $status->id_str;
                $text = $status->text;
                $name = $status->user->name;
                $screen_name = $status->user->screen_name;
                //$href = $status->entities->media[0]->expanded_url;
                $date = $status->created_at;
                echo "<br>";


                echo '<blockquote class="twitter-tweet" data-conversation="none" data-lang="en"><p lang="und" dir="ltr">'.$text.'</p>&mdash; '.$name.' (@'.$screen_name.') <a href="https://twitter.com/'.$screen_name.'/status/'.$id.'">'.$date.'</a></blockquote>';
            }
          }
        ?>
      </div>  
    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  </body>
</html>





