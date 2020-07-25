<?php

session_start();

include "connection.php";

if (!isset($_SESSION["user_name"]) || !isset($_SESSION["password"])) {

    header("location: denied.php");
}


$id = $_POST["id"];
$votetype = $_POST["vote_type"];
$username = $_SESSION["user_name"];


//Up Vote
if ($votetype == "upvote") {

        $sql = "SELECT * FROM user_attr WHERE username = '$username' AND thread_id = $id";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) == 0) {
                $sql = "INSERT INTO user_attr VALUES('$username',$id,1)";
                $result = mysqli_query($con, $sql);

                $sql = "SELECT up_votes from thread where thread_id = $id;";

                $result = mysqli_query($con, $sql);

                $count = 0;
                if (mysqli_num_rows($result) > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {
                                $count = $rows["up_votes"];
                            }
                    }

                $count = $count + 1;

                $sql = "update thread set up_votes = $count where thread_id = $id;";

                mysqli_query($con, $sql);
                echo $count;
            } else {
            $sql = "SELECT vote FROM user_attr WHERE username = '$username' AND thread_id = $id;";

            $result = mysqli_query($con, $sql);
            $rows1 = mysqli_fetch_assoc($result);
            $voteflag = $rows1["vote"];

            if ($voteflag == 1) {

                $sql = "SELECT up_votes from thread where thread_id = $id;";

                $result = mysqli_query($con, $sql);
                $count = 0;
                if (mysqli_num_rows($result) > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {
                                $count = $rows["up_votes"];
                            }
                        $count = $count - 1;
                    }
                $sql = "update user_attr set vote = 0 where username = '$username' AND thread_id = $id;";

                mysqli_query($con, $sql);

                $sql = "update thread set up_votes = $count where thread_id = $id;";

                mysqli_query($con, $sql);
                echo $count;
            } 
            elseif($voteflag == 0) {

                $sql = "UPDATE user_attr SET vote = 1 where username = '$username' AND thread_id = $id;";
                $result = mysqli_query($con, $sql);

                $sql = "SELECT up_votes from thread where thread_id = $id;";

                $result = mysqli_query($con, $sql);
                $count = 0;
                if (mysqli_num_rows($result) > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {
                                $count = $rows["up_votes"];
                            }
                    }

                $count = $count + 1;

                $sql = "update thread set up_votes = $count where thread_id = $id;";

                mysqli_query($con, $sql);
                echo $count;
            }
            else{
                $sql = "SELECT up_votes,down_votes from thread where thread_id = $id;";

                $result = mysqli_query($con, $sql);

                $count = 0;
                $count1 = 0;
                if (mysqli_num_rows($result) > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {
                                $count = $rows["up_votes"];
                                $count1 = $rows["down_votes"];
                            }
                        $count = $count + 1;
                        $count1 = $count1 - 1;
                    }
                $sql = "update user_attr set vote = 1 where username = '$username' AND thread_id = $id;";

                mysqli_query($con, $sql);

                $sql = "update thread set up_votes = $count, down_votes = $count1 where thread_id = $id;";

                mysqli_query($con, $sql);
                echo $count;
            }
        }
    }






//Down Vote 
else { 

    $sql = "SELECT * FROM user_attr WHERE username = '$username' AND thread_id = $id";
        $result = mysqli_query($con, $sql);

        if (mysqli_num_rows($result) == 0) {

                $sql = "INSERT INTO user_attr VALUES('$username',$id,1)";
                $result = mysqli_query($con, $sql);

                $sql = "SELECT up_votes,down_votes from thread where thread_id = $id;";

                $result = mysqli_query($con, $sql);
                $count = 0;
                if (mysqli_num_rows($result) > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {
                                $count = $rows["down_votes"];
                            }
                    }

                $count = $count + 1;

                $sql = "update thread set up_votes = $count where thread_id = $id;";

                mysqli_query($con, $sql);
                echo $count;
            } 
            else {

            $sql = "SELECT vote FROM user_attr WHERE username = '$username' AND thread_id = $id;";

            $result = mysqli_query($con, $sql);
            $rows1 = mysqli_fetch_assoc($result);
            $voteflag = $rows1["vote"];

            if ($voteflag == 1) {

                $sql = "SELECT up_votes,down_votes from thread where thread_id = $id;";

                $result = mysqli_query($con, $sql);

                $count = 0;
                $count1 = 0;
                if (mysqli_num_rows($result) > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {
                                $count = $rows["up_votes"];
                                $count1 = $rows["down_votes"];
                            }
                        $count = $count - 1;
                        $count1 = $count1 + 1;
                    }
                $sql = "update user_attr set vote = -1 where username = '$username' AND thread_id = $id;";

                mysqli_query($con, $sql);

                $sql = "update thread set up_votes = $count, down_votes = $count1 where thread_id = $id;";

                mysqli_query($con, $sql);
                echo $count1;
            } 
            elseif ($voteflag == 0)
            {

                $sql = "UPDATE user_attr SET vote = -1 where username = '$username' AND thread_id = $id;";
                $result = mysqli_query($con, $sql);

                $sql = "SELECT down_votes from thread where thread_id = $id;";

                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {
                                $count = $rows["down_votes"];
                            }
                    }

                $count = $count + 1;

                $sql = "update thread set down_votes = $count where thread_id = $id;";

                mysqli_query($con, $sql);
                echo $count;
            }
            else{
                $sql = "UPDATE user_attr SET vote = 0 where username = '$username' AND thread_id = $id;";
                $result = mysqli_query($con, $sql);

                $sql = "SELECT down_votes from thread where thread_id = $id;";

                $result = mysqli_query($con, $sql);

                if (mysqli_num_rows($result) > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {
                                $count = $rows["down_votes"];
                            }
                    }

                $count = $count - 1;

                $sql = "update thread set down_votes = $count where thread_id = $id;";

                mysqli_query($con, $sql);
                echo $count;
            }
        }


}

?>
