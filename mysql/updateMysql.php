
<?php
    session_start();
    
        $_SESSION['entry'] = $('#textarea').val();

        $sql = "UPDATE `diaryUsers` SET `diaryEntry` = ".$_SESSION['entry']." WHERE 
      `email` = '".$_SESSION['user']."'";
        $result = mysqli_query($conn, $sql);  
        if($result){
            return ("DATA SAVED SUCCESSFULLY");
        } else{
            return ("Input data is fail");
        }


?>