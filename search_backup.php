<?php
session_start();

include "connection.php";

$input = $_POST["input"];

if($input=="")
{

    $sql = "select title, post_count, report_count, thread_id,up_votes,down_votes,category from thread where status=0 ORDER BY created_time DESC LIMIT 4";

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
            while ($rows = mysqli_fetch_assoc($result)) {
                $sql1 = 'SELECT subject FROM category WHERE cat_id = ' . $rows["category"] . ';';
                $result1 = mysqli_query($con, $sql1);   
                $rows1 = mysqli_fetch_assoc($result1);

                    echo '<div class="card bg-light mt-2"
                    style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border:none;">
                    <div class="card-header pb-0 px-1">
                    <h3 class="text-capitalize" style=" font-size:2.5vw"><a href="thread.php?title=' . $rows["title"] . '&id=' . $rows["thread_id"] . '" style="text-decoration: none;">' . $rows["title"] . '</a></h3>
                    </div>
                    <div class="card-body px-1 py-0" >
                        
                        <span class = "text-danger ml-1" style = "font-style:italic;display:block;font-size:1.2vw">Category: ' . $rows1["subject"] . '</span>
                    </div>
                    <div class="card-footer bg-secondary" style="border:none;padding:0">
                    <p class="m-0">
                        <div class="d-flex justify-content-between py-1 px-1">
                            <div class="">
                            
                                <i id = "thumbsup" class="fas fa-arrow-up fa-2x text-success" onclick="upvote('.$rows["thread_id"].'0);" style="font-size:2vw;"></i>
                                <h3 id="'.$rows["thread_id"].'0" class="text-white ml-1" style="display:inline;font-size:2vw;;margin-bottom:0;">'.$rows["up_votes"].'</h3>
                                <i id = "thumbsup" class="fas fas fa-arrow-down fa-2x text-danger ml-4" onclick="downvote('.$rows["thread_id"].'1);" style="font-size:2vw;"></i>
                                <h3 id="'.$rows["thread_id"].'1" class="text-white ml-1" style="display:inline;font-size:2vw;">' . $rows["down_votes"] . '</h3>
                            </div>
                            
                            <div class="delete">
                            <i class="fas fa-times fa-2x text-danger" onclick="threaddlt('.$rows["thread_id"].')" style="font-size:2vw;"></i>
                           </div>
                            <div class="">
                                <i class="fa fa-list-ol fa-2x text-info" style="font-size:2vw;"></i>
                                <h3 class="text-white ml-1 " style="display:inline;font-size:2vw;">' . $rows["post_count"] . '</h3>
                            </div>
                        </div>
                        </p>
                    </div>
                </div>';
                }
        } else {

        echo "<h2 class='text-center mt-5' style='font-size:5vw'>NO THREADS!</p>";
    }


}
else
{

$sql = "select DISTINCT(title), post_count, thread.report_count, thread.thread_id,up_votes,down_votes,category from thread join post on thread.thread_id = post.thread_id where thread.status=0 and (thread.title LIKE '%$input%'or post.content LIKE '%$input%') and post.status=0 ORDER BY created_time DESC";

$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
        while ($rows = mysqli_fetch_assoc($result)) {
            $sql1 = 'SELECT subject FROM category WHERE cat_id = ' . $rows["category"] . ';';
            $result1 = mysqli_query($con, $sql1);   
            $rows1 = mysqli_fetch_assoc($result1);

                echo '<div class="card bg-light mt-2"
                style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border:none;">
                <div class="card-header pb-0 px-1">
                <h3 class="text-capitalize" style=" font-size:2.5vw"><a href="thread.php?title=' . $rows["title"] . '&id=' . $rows["thread_id"] . '" style="text-decoration: none;">' . $rows["title"] . '</a></h3>
                </div>
                <div class="card-body px-1 py-0" >
                    
                    <span class = "text-danger ml-1" style = "font-style:italic;display:block;font-size:1.2vw">Category: ' . $rows1["subject"] . '</span>
                </div>
                <div class="card-footer bg-secondary" style="border:none;padding:0">
                <p class="m-0">
                    <div class="d-flex justify-content-between py-1 px-1">
                        <div class="">
                        
                            <i id = "thumbsup" class="fas fa-arrow-up fa-2x text-success" onclick="upvote('.$rows["thread_id"].'0);" style="font-size:2vw;"></i>
                            <h3 id="'.$rows["thread_id"].'0" class="text-white ml-1" style="display:inline;font-size:2vw;;margin-bottom:0;">'.$rows["up_votes"].'</h3>
                            <i id = "thumbsup" class="fas fas fa-arrow-down fa-2x text-danger ml-4" onclick="downvote('.$rows["thread_id"].'1);" style="font-size:2vw;"></i>
                            <h3 id="'.$rows["thread_id"].'1" class="text-white ml-1" style="display:inline;font-size:2vw;">' . $rows["down_votes"] . '</h3>
                        </div>
                       
                        <div class="delete">
                        <i class="fas fa-times fa-2x text-danger" onclick="threaddlt('.$rows["thread_id"].')" style="font-size:2vw;"></i>
                       </div>
                        <div class="">
                            <i class="fa fa-list-ol fa-2x text-info" style="font-size:2vw;"></i>
                            <h3 class="text-white ml-1 " style="display:inline;font-size:2vw;">' . $rows["post_count"] . '</h3>
                        </div>
                    </div>
                    </p>
                </div>
            </div>';
            }
    } else {

    echo "<h2 class='text-center mt-5' style='font-size:5vw'>NO THREADS!</p>";
}
}

?>