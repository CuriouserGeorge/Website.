<?php
if($_POST){
    $to = $_POST['to_email'];
    $from = $_POST['from_email'];
    $messge = $_POST['content_email'];

//send email
    mail($to, "This is an email from:" .$from, $message);
}
?>