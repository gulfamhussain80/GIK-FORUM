<?php

session_start();
if(isset($_POST["a"]))
{
session_destroy();
}
else
{
include "connection.php";
$name = $_SESSION["user_name"];
$content = $_POST["post-area"];
$id = $_SESSION["id"];
if($_SERVER["REQUEST_METHOD"]=="POST")
{
    include "../forum-connection.php";
    $content = $_POST["post-area"];

    $sql = "INSERT INTO post(thread_id,posted_on,posted_by,content,status,report_count) VALUES($id,now(),'$name','$content',0,0);";

    mysqli_query($con,$sql);

    $sql = "select post_count from thread where thread_id=$id;";
    $result = mysqli_query($con,$sql);

    if(mysqli_num_rows($result)>0)
    {
      while($rows= mysqli_fetch_assoc($result))
      {
          $count = $rows["post_count"];
      }

    }
    
    $count=$count +1;

    $sql= "update thread set post_count = $count;";
    mysqli_query($con,$sql);


    header("location: home.php");

}
}
?>