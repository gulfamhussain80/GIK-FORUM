<?php

session_start();

include "connection.php";

if (!isset($_SESSION["user_name"]) || !isset($_SESSION["password"])) {

        header("location: denied.php");
    }


$id = $_POST["id"];
$username = $_SESSION["user_name"];

$sql = "SELECT * FROM user_attr WHERE username = '$username' AND thread_id = $id";
$result = mysqli_query($con,$sql);

if(mysqli_num_rows($result) == 0)
{
    $sql = "INSERT INTO user_attr VALUES('$username',$id,1)";
    $result = mysqli_query($con,$sql);

    $sql= "SELECT up_votes from thread where thread_id = $id;";

    $result = mysqli_query($con,$sql);
    
    if(mysqli_num_rows($result) > 0)
    {
     while($rows = mysqli_fetch_assoc($result))
     {
         $count = $rows["up_votes"];
    
     }
    
    }
    
    $count = $count +1;
    
    $sql= "update thread set up_votes = $count where thread_id = $id;";
    
    mysqli_query($con,$sql);
    echo $count;

}
else{
    $sql= "SELECT up_votes from thread where thread_id = $id;";

    $result = mysqli_query($con,$sql);
    
    if(mysqli_num_rows($result) > 0)
    {
     while($rows = mysqli_fetch_assoc($result))
     {
         $count = $rows["up_votes"];
    
     }
    
    }
    echo $count.'<script>window.alert("You cannot upvote a thread more than once.")</script>';

}




?>