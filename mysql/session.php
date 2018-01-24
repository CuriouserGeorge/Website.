<?php

  session_start();
  
  
  echo $_SESSION['username'];
  echo($_SESSION['email']);
  
  if($_SESSION['email']){
    
    echo "your email is". $_SESSION['email'];
    
    
  }else{
    
    header("Location: index.php");
    
  }

?>