<?php
    include("functions.php");
    if ($_GET['action'] == 'loginSignUp'){
        
        $error = "";
        
        if(!$_POST['email']){
            
            $error = "An email is required";
            
        }else if(!$_POST['password']){
            
            $error = "A password is required";
            
        }else if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false){
            
            $error = "Please enter a valid email address";
        }
        if($error){
            
            echo $error;
            exit();
        }
        
        
        if($_POST['loginActive'] == "0"){
            
            $query = "SELECT * from Users WHERE email = '" . mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";
            $result = mysqli_query($link, $query);
            
            if (mysqli_num_rows($result) > 0){
                
                $error = "That email address is already taken.";
            }else{
                
                
                $query = "INSERT INTO `Users`(`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."','".mysqli_real_escape_string($link, $_POST['password'])."')";
                
                if (mysqli_query($link, $query)){
                    $_SESSION['id'] = mysqli_insert_id($link);
                    $query = "UPDATE `Users` SET `password`='". password_hash($_POST['password'], PASSWORD_DEFAULT)."' WHERE `id` = ". $_SESSION['id'];
                        
                    //echo "query is".$query;
                    
                     if (mysqli_query($link, $query)){
                         
                         echo "1";
                         

                     }
                        
                }else{
                    
                    $error = "couldn't create user";
                }
            }
                
        }else{
            $query = "SELECT * FROM `Users` WHERE `email`='".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

            $result = mysqli_query($link, $query);
            $row = mysqli_fetch_assoc($result);
                if(password_verify($_POST['password'], $row['password']) ){
                    
                    echo 1;
                    
                    $_SESSION['id'] = $row['id'];
                    
                }else{
                    
                    $error = "Could not find that username : password combination";
                }
            
            
        }
            
        
         if($error != ""){
            
            echo $error;
            exit();
        }
        
        
    }

    if ($_GET['action'] == 'toggleFollow'){
        $query = "SELECT * FROM `isFollowing` WHERE `follower` = " . mysqli_real_escape_string($link, $_SESSION['id'])." AND isFollowing=".mysqli_real_escape_string($link, $_POST['userId'])." LIMIT 1";
        $result = mysqli_query($link, $query);
        //echo $query;
        
        $result = mysqli_query($link, $query);
        
        if (mysqli_num_rows($result) > 0){
            
            $row = mysqli_fetch_assoc($result);
            
            $query =  "DELETE FROM  `isFollowing` WHERE id= '". mysqli_real_escape_string($link, $row['id'])."' LIMIT 1";
                

            mysqli_query($link, $query) ;
            //echo $query;
            echo "1";
            
        }else{
            $query = "INSERT INTO  `isFollowing` (follower, isFollowing) VALUES (". mysqli_real_escape_string($link, $_SESSION['id']).",".mysqli_real_escape_string($link, $_POST['userId']).")";
            //echo $query;
            mysqli_query($link, $query);
            
            echo "2";
        }
    }

    if ($_GET['action'] == 'postTweet'){
        
        
        if(!$_POST['tweetContent']){
            
            echo "Your tweet is empty!";
        }else if (strlen($_POST['tweetContent']) > 280){
            
            echo "Your tweet is too long (280 characters max)";
        }else {
            
            $query = "INSERT INTO  `tweets` (`tweet`, `userid`, `dateTime`) VALUES ('". mysqli_real_escape_string($link, $_POST['tweetContent'])."', '".mysqli_real_escape_string($link, $_SESSION['id'])."', NOW())";
            
            mysqli_query($link, $query);
            
            echo "1";
        }
    }
?>