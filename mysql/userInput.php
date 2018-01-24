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

  if(isset($_POST['username'],$_POST['email'],$_POST['password'])){       $user = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  }


  //validate inputs

  /*if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }*/




  
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
    if($unique_user){
      $sql = "INSERT INTO diaryUsers (`username`, `email`, `password`)
      VALUES ('$user', '$email', '$password')";


      if (mysqli_query($conn, $sql)) {
          echo "New record created successfully";
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


<form method="post">
  Username <br>
  <input type="text" name="username"><br>
  <?php if(isset($user_error)){  echo $user_error; }?>
  Email<br>
  <input type="text" name="email"><br>
  <?php if(isset($email_error)){echo $email_error;} ?>
  Password<br>
  <input type="password" name="password"><br>
  <input type="radio" name="stayLogged"><br>
  <input type="submit" value="Submit">
</form>

<form method="post">
  Email <br>
  <input type="text" name="email_user"><br>
  Password <br>
  <input type="password" name="password_user"><br>
  <?php if(isset($password_error)){echo $password_error;} ?>

  <input type="radio" name="stayLogged"><br>
  <input type="submit" value="Submit">
</form>