<?php

$server= "localhost";
$username="root";
$pass="12345";

$con = mysqli_connect($server,$username,$pass,"gikiforum");

if(!$con){

    die("connection failed".mysqli_connect_error());
}
else
{
   
    
}

?>
