<?php
session_start();

if(!isset($_SESSION["user_name"]) || !isset($_SESSION["password"])) 
{

    header("location: denied.php");


}



include "connection.php";



$name = $_SESSION["user_name"];
$content = $_POST["tent"];
$id = $_SESSION["id"];
    

    $sql = "INSERT INTO post(thread_id,posted_on,posted_by,content,status,report_count) VALUES($id,now(),'$name','$content',0,0);";

    mysqli_query($con,$sql);

    $sql = "select post_count from thread where thread_id=$id AND status = 0;";
    $result = mysqli_query($con,$sql);

    if(mysqli_num_rows($result)>0)
    {
      while($rows= mysqli_fetch_assoc($result))
      {
          $count = $rows["post_count"];
      }

    }
    
    $count=$count +1;

    $sql= "update thread set post_count = $count where thread_id= $id";
    mysqli_query($con,$sql);
    $sql = "select post_count from user where username = '$name'";
    $result = mysqli_query($con,$sql);
    $rows= mysqli_fetch_assoc($result);
    $usercount = $rows["post_count"];
    $usercount = $usercount + 1;

    $sql= "update user set post_count = $usercount where username = '$name'";
    mysqli_query($con,$sql);
//USER KA POST COUNT BHI PLUS KARNA HAI


?>
