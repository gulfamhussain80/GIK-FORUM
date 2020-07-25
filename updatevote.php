<?php
    session_start();

    include "connection.php";
    
    if (!isset($_SESSION["user_name"]) || !isset($_SESSION["password"])) {
    
        header("location: denied.php");
    }
    
    
    $id = $_POST["id"];
    $votetype = $_POST["vote_type"];

    if($votetype == "upvote"){
        $sql = "SELECT up_votes FROM thread WHERE thread_id = $id;";
        $result = mysqli_query($con,$sql);
        $rows = mysqli_fetch_assoc($result);
        $upvotes = $rows["up_votes"];
        echo $upvotes;
    }
    else{
        $sql = "SELECT down_votes FROM thread WHERE thread_id = $id;";
        $result = mysqli_query($con,$sql);
        $rows = mysqli_fetch_assoc($result);
        $downvotes = $rows["down_votes"];
        echo $downvotes;
    }  

?>