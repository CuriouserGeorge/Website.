<html>
  <head>
      
    <title>PHP</title>
    <link href="android.png" rel="icon">
    <link id="css" rel="stylesheet" type="text/css" href="php.style.css">
    <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>


    
    <script src="https://use.fontawesome.com/a8be89c781.js"></script>






    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    

  </head>

  <p>Is it prime? (using GET)</p>
  <form>
    <input name="number" type="text">
    <input type = "submit" value="test">


  </form>
  <?php
    if($_GET['number']){
      $num = $_GET['number'];

      $factors = "";

      if(ctype_digit($num)){
        $test = floor(sqrt($num));

        while($test > 1){
          if($num%$test == 0){
            $factor = $num / $test;
            $factors .= $test."*".$factor."<br>";

          }
          $test--;

        }
        if($factors == ""){

          echo "this number is prime!";

          }else{

          echo $num." is not prime <br>"."its factors are :<br>".$factors;
          }
        }else{
        echo $num." is not an integer";
      } 
    }else{
      echo("please enter an integer");
    }


  ?>


    <p>Do i know you? (using post)</p>
    <form method="post">
      <input name="name" type="text">
      <input type="submit" value="check">
    </form>


  <?php
    $USERS = array("tom","richard","harry","dave","bob");
    echo $_POST['name'];
    if (array_search($_POST['name'], $USERS)){
      echo "<br> you're in!<br>";

    }else{
      echo "<br>You're not there";
    }

  ?>

    <p>Send yourself an Email</p>
  
    <div id="error" class="alert alert-danger collapse"></div>
    <form id="send_email" method="post">
      <div class="form-group">
        <label class="col-form-label" for="emailInput">Your Email</label>
        <input type="email" class="form-control" id="emailInput" placeholder="Example@example.com" name="to">
      </div>
      <div class="form-group">
        <label class="col-form-label" for="subjectInput">Subject</label>
        <input type="text" class="form-control" id="subjectInput" placeholder="RE:" name="subject">
      </div>
      <div class="form-group">
        <label class="col-form-label" for="content">Content</label>
        <textarea id="contentInput" class="form-control" rows="4" name="content" placeholder="Enter your text here..."></textarea>
      </div>
      <button type="submit" id="submit" class="btn btn-primary" >Submit</button>
    </form>
  

  <?php

    $to = $_POST['to'];
    $subject = $_POST['subject'];
    $txt = $_POST['content']."<br>sent from georgetimbrell.co.uk/PHP";
    $headers = "From:  php@georgetimbrell.co.uk"."\r\n";
    //mail($to,$subject,$txt,$headers);
    



  ?>
  <script type="text/javascript">
    $('#send_email').submit(function (evt) {
      //console.log("submitted")
      //window.history.back();
      
      let errorMessage = "";
      
      if($("#subjectInput").val()==""){
        
        errorMessage += "No subject entered. "  
        
      }
      if($("#emailInput").val()==""){
        
        errorMessage += "No email entered.. "  
        
      }      
      if($("#contentInput").val()==""){
        
        errorMessage += "No text entered. "  
        
      }
      
      if(errorMessage != ""){
        evt.preventDefault();

        console.log("non empty string")
        $("#error").html(errorMessage);
        $("#error").show();
      }else{
        console.log("email sent");
      }

      
    });
  
  
  </script>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</html>
