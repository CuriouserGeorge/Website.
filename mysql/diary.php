<?php
  ob_start();
  // Start the session
  session_start();

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
  echo "Connected successfully";

  if(isset($_POST['username'],$_POST['email'],$_POST['password'],$_POST['confirm'])){           $user = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  }


  //validate inputs
  $valid_input = TRUE;
  /*if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }*/
  
  if (empty($_POST["confirm"])) {
    $confirm_error = "Please confirm your password";
    $valid_input = FALSE;
  } else {
      if($_POST["confirm"] != $_POST["password"]){
        $confirm_error = "passwords do not match";
        $valid_input = FALSE;
      }
    }
  

  




  
  //checks to see if username or email is currently being used
  $sql = "SELECT `index`,`username`,`email` FROM `diaryUsers` WHERE 1";
  $result = mysqli_query($conn, $sql);

  if(isset($user, $email, $password)){

    $unique_user = TRUE;

    if (mysqli_num_rows($result) > 0) {
      //checks email and username
      while($row = mysqli_fetch_assoc($result)) {

        if($row["username"] == $user){
          $user_error =  "username already taken<br>";
          $unique_user = FALSE;
        }
        if($row["email"] == $email){
          $email_error  = "email already taken<br>";
          $unique_user = FALSE;
          //echo "email match";
        }
      }
    }
    if($unique_user && $valid_input){
      $sql = "INSERT INTO diaryUsers (`username`, `email`, `password`)
      VALUES ('$user', '$email', '$password')";


      if (mysqli_query($conn, $sql)) {
          echo "New record created successfully";
          $_SESSION['email'] = $email;
          $cookie_name = "user";
          $cookie_value = $email;
          setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
          header('Location: index.php');
                } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }

    }
  }
  if(isset($_POST['email_user'],$_POST['password_user'])){
    
    $login_email = $_POST['email_user'];
    $login_password = $_POST['password_user'];
  
  }

  if(isset($login_email, $login_password)){
    
    echo "user and password enetered";
    
    
    
    
    $sql = "SELECT `password` FROM `diaryUsers` WHERE `email` = '$login_email' ";
    
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    
    if(password_verify($login_password, $row[0])){
      $_SESSION['email'] = $login_email;
      $cookie_name = "user";
      $cookie_value = $login_email;
      setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        header('Location: index.php');
    }else{
      
      $password_error = "incorrect password<br>";
    }
    
  }


  mysqli_close($conn);

?>
<html>
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    
    <link id="css" rel="stylesheet" type="text/css" href="style.diary.css">
    
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    
    

    <title>Diary</title>
    <style>

    
    
    
    
    </style>
  </head>
    <body>
      <div class="main">
        <div clas="container">
          <div class="row h-100 justify-content-center ">
            <div id="register" class="col-4 align-middle">
              <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="pills-home-tab" data-toggle="tab" href="#pills-home" data-toggle="tab" role="tab" aria-controls="pills-home" aria-selected="true">Register</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="pills-profile-tab" data-toggle="tab" href="#pills-profile" data-toggle="tab" role="tab" aria-controls="pills-profile" aria-selected="false">Log in</a>
                </li>
              </ul>  

              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                  <form method="post">
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" id="username" name="username">
                      <?php if(isset($user_error)){  echo $user_error; }?>
                    </div>
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" name="email">
                      <?php if(isset($email_error)){echo $email_error;} ?>
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <div class="form-group">
                      <label for="confirm">Confirm Password</label>
                      <input type="password" class="form-control" id="confirm" name="confirm">
                      <?php if(isset($confirm_error)){echo $confirm_error;} ?>
                    </div>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" name="stayLogged" type="checkbox" value="Stay logged in?">
                      </label>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                  </form>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">            
                  <form method="post">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email_user" name="email_user">
                    </div>
                    <div class="form-group">
                      <label for="password">Password</label>
                      <input type="password" class="form-control" id="password_user" name="password_user">
                    </div>
                    <?php if(isset($password_error)){echo $password_error;} ?>
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" name="stayLogged" type="checkbox" value="Stay logged in?">
                      </label>
                    </div>
                    <button type="submit" class="btn btn-primary">login</button>
                    <p><a href="passReset.php">forgotten password?</a></p>
                  </form>
                </div>
              </div>  
            </div>
          </div>
        </div>
    </div>

      
  </body>
  <script>


  </script>
  
</html>  