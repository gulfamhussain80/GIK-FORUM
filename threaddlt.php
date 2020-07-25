<?php

session_start();
include "connection.php";

if(!isset($_POST["flag"]))
{
    $ID = $_POST["id"];

    $sql = "update thread set status = 1 where thread_id = $ID;";
    
    mysqli_query($con,$sql);
    
}
else
{


$pstid = $_POST["idd"];
$tid= $_POST["tid"];
$sql= "update post set status = 1 where post_id = $pstid;";
mysqli_query($con,$sql);

$sql = "update thread set post_count = post_count -1 where thread_id = $tid;";
mysqli_query($con,$sql);


}




?>