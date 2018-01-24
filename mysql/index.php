<?php
  session_start();

  //echo "you are logged in as ";
  //echo $_COOKIE["user"];

  if(isset($_POST['diary'])){$entry = $_POST['diary'];}
  $user = $_COOKIE['user'];
  
  
  //create connection
  $servername = "shareddb1e.hosting.stackcp.net";
  $username = "myUsers-32330e3f";
  $password = "password";
  $DBname = $username;
  

  $conn = mysqli_connect($servername, $username, $password,$DBname);
  // Check connection
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
  //echo "Connected successfully";



    if(isset($entry)){
      
      $sql = "UPDATE `diaryUsers` SET `diaryEntry` = '$entry' WHERE 
      `email` = '$user'" ;
      
      $result = mysqli_query($conn, $sql);  
        if($result){
          //echo ("DATA SAVED SUCCESSFULLY");
        }else{
        //echo("Input data is fail");
        }
    }



    
  $sql = "SELECT `diaryEntry` FROM `diaryUsers` WHERE `email` = '$user'" ;

  $result = mysqli_query($conn, $sql);  
  if($result){
      //echo ("DATA LOADED SUCCESSFULLY");
      $row = mysqli_fetch_array($result, MYSQLI_NUM);
      $text = $row[0];
  } else{
        //echo("Input data is fail");
    }

?>

<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    
    <link id="css" rel="stylesheet" type="text/css" href="style.diary.css">
    
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    

    
  </head>
  
  
  <body>
    <div class="main">

      <textarea id="diary" name="diary" form="usrform"  method="post" placeholder="tell me your secrets"><?php echo $text ?></textarea>
      
      <form method="post"  id="usrform">
      <input type="submit" value="save">
      </form>
      
      
      
    </div>
  
  
  </body>
  <?php

  
  
  //update mysql
  //echo $_POST['diary'];

  

  
  
  
  
  ?>
  <script>
    
      
  
  </script>


</html>