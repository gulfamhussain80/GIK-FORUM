<?php
include "connection.php";

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){

    $email = $_GET['email'];
    $hash = $_GET['hash'];


    $query = "SELECT email, hash, active FROM user WHERE email='".$email."' AND hash='".$hash."' AND active='0'";
    $result=mysqli_query($con,$query); 
    $count=mysqli_num_rows($result);

    if($count > 0){
        
        $query="UPDATE user SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'";
        $result=mysqli_query($con,$query);

        if(!$result){
       
            die('failed query'. mysqli_error($con));
        }
        else
        {
            echo '<div class="errmsg">Your account has been activated successfully, you can now login by clicking on the link below<br><a href="index.php">LOGIN!</a></div>';
        }

        
    }else{
        
        echo '<div class="errmsg">The url is either invalid or you already have activated your account.</div>';
    }
}
else
{
    echo '<div class="errmsg">please use the link that has been sent to your email.</div>';
}


?>