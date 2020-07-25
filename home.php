<?php

session_start();


if (!isset($_SESSION["user_name"]) || !isset($_SESSION["password"])) {

        header("location: index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Start</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!--font-awesome-->
    <script src="./js/all.js"></script>

    <!-- main css-->
    <style>
        .header {
            background: url("images/GIKI2.jpg");
            background-size: cover;
            background-position:fixed;
            background-repeat: no-repeat;
        }

        .nav-link {
            font-size: 1.5rem;
            transition: font-size 0.5s ease-out;
        }

        .nav-link:hover {
            font-size: 1.8rem;
        }

        body {
            /* font-family: 'Raleway', sans-serif; */
            font-family: 'Lato', sans-serif;
            /* font-family: 'Ubuntu', sans-serif; */
            margin-bottom: 5px;
        }
        .card p{
            margin:0px;
        }
        .card-header h3 a {
            color: #235daa;
            transition: color 0.5s ease-in-out, font-size 0.5s ease-in-out , font-weight 0.5s ease-in-out;
        }

        .card-header h3 a:hover {
            color: #0a2a55;
            font-weight: bold;
            font-size: 3vw;
        }
        #thumbsup{
            font-size:3vw;
        }
        .nohover {
            pointer-events: none;
        }
        #thumbsup:hover{
            cursor: pointer;
            -webkit-animation: myanimation 4s;
        }
    </style>

    <!-- google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Karla" rel="stylesheet">

</head>

<body>



    <div class="container-fluid" style="margin-bottom: 0">


        <!-- header -->
        <div class="row header pb-3 pt-4">
            <div class="col">
                <h1 class="display-3 font-weight-bold">GIK <span style="color:#062b5c;font-weight: lighter">Forum</span>
                </h1>
            </div>
        </div>
        <!-- end header -->


    </div>


    <!-- Main Menu Navigation(Home,Contact Us,Account,Search Box) -->
    <nav class="navbar navbar-expand-lg navbar-light" style="background:#0f3f7e">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link text-white" href="home.php"><i class="fa fa-home mr-2"></i>Home <span
                            class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="contact.php">Contact Us</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="aboutus.php">About Us</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Account
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item " href="account.php">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item text-danger" onclick="des()" href="index.php">Sign Out</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" onkeyup="sea(this.value)" aria-label="Search">
            </form>
        </div>
    </nav>
    <!-- End of Main Menu -->

<script>
function des()
{
var a = 1;
$.ajax({
    url: "post.php",
    type: "POST",
    data: {a},
    success: function(result)
    {

    }

});

}

</script>


<script>
function sea(input)
{
   $.ajax({

       url: "search.php",
       type: "POST",
       data: {input},
       success: function(result){
    
           $("#threads").html(result);
           if(type!="admin" && type!="moderator")
{
    var elems =document.getElementsByClassName("delete");
    for (var i=0;i<elems.length;i+=1){
  elems[i].style.display = 'none';
}
                } 
          
       }

});
}
</script>
<script>
    var flag1 = 0;
        function likedthreads(){
            flag1 = 1;
            $.ajax({
                url:'likedthreads.php',
                type:'POST',
                success: function(result){
                    $("#threads").html(result);
                    if(type!="admin" && type!="moderator")
{
    var elems =document.getElementsByClassName("delete");
    for (var i=0;i<elems.length;i+=1){
  elems[i].style.display = 'none';
}
                } }

            });
        }
    </script>




    <!-- Create a Thread Button -->
    <div class="container-fluid">
        <div class="row de-flex justify-content-center">
            <button class="text-uppercase btn btn-success btn-sm" style="width: 350px;border-top-left-radius: 0px;border-top-right-radius: 0px;margin-bottom:20px; font-size: 1.2rem" data-toggle="modal" data-target="#myModal">create a thread!</button>
        </div>
    </div>

    <!-- End of Button -->
    <!--start of modal-->

    <!-- The Modal -->
    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">New Thread</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <!-- FORM START-->
                    <form action="home.php" method="POST">

                        <!--THREAD TITLE-->
                        <div class="input-group mb-3 form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Thread Title</span>
                            </div>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <!--thread title input end-->
                        <!--select categories-->
                        <div class="input-group mb-3 form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Category</span>
                                <select name="categories" id="cat" class="form-control" required>
                                    <option value = "">Select a category</option>
                                    <?php
                                    include "connection.php";

                                    $sql = "select subject from category";

                                    $result = mysqli_query($con, $sql);

                                    if (mysqli_num_rows($result) > 0) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                    echo "<option>";
                                                    echo $row["subject"];
                                                    echo "</option>";
                                                }
                                        }
                                    ?>
                                </select>
                                <div id="warning"></div>
                            </div>
                        </div>
                        <!--end categories-->
                        <!--start Text Area-->
                        <div class="form-group">
                            <label for="comment">Content</label>
                            <textarea class="form-control" rows="5" id="comment" name="text-area" required></textarea>
                        </div>
                        <!--end text area-->

                </div>

                <!-- Modal footer -->
                <div class="modal-footer d-flex justify-content-around">
                    <input type="submit" class="btn btn-success">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>

                </div>
                </form>
                <!--FORMM END-->

            </div>
        </div>
    </div>
    <!--end of modal-->

    <!--PHP SCRIPT-->

    <?php


    include "connection.php";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST["title"];

            $subject = $_POST["categories"];

            $content =  mysqli_real_escape_string($con, $_POST["text-area"]);

            $sql = "select cat_id from category where subject = '$subject';";

            $result = mysqli_query($con, $sql);

            $row = mysqli_fetch_assoc($result);

            $id = $row["cat_id"];
            $name = $_SESSION["user_name"];

            $sql = "INSERT INTO thread(title,created_time,created_by,post_count,status,category,report_count,up_votes,down_votes) VALUES('$title',now(),'$name',1,0,'$id',0,0,0);";

            mysqli_query($con, $sql);

            $sql = "select thread_id from thread where title = '$title' ORDER BY created_time  DESC;";

            $result = mysqli_query($con, $sql);

            $row = mysqli_fetch_assoc($result);

            $id = $row["thread_id"];



            $sql = "INSERT INTO post(thread_id,posted_on,posted_by,content,status,report_count) VALUES($id,now(),'$name','$content',0,0);";

            mysqli_query($con, $sql);
        }




    ?>



    <!--PHP SCRIPT END-->





    <!-- Sort By Navigation Bar -->
    <div class="" style="width: 35vw;height:3.3vw;border-top-right-radius: 8px;border-bottom-right-radius: 8px; background:#0a2a55">
        <div class="row">
            <div class="mt-1 ml-sm-1 ml-md-1 mr-md-1 ml-xs-1 col-sm-3 col-md-3 col-xs-1 text-light" style="font-size:1.8vw; width:10vw;padding-right:0;">
                Sort By
            </div>
            <div class="col-sm-4 col-md-4 col-xs-4 ml-sm-1 ml-md-2 mr-md-1 mr-sm-1 my-0 " style="width:15vw;padding-right:0;">
                <a class="nav-link text-danger px-0 py-0" style="font-size:1.5vw" href="#" onclick="hotsort()"><i class="fa fa-fire"></i> Hot Threads</a>
            </div>
            <div class="col-sm-4 col-md-4 col-xs-4 ml-md-0 my-0 px-0 py-0 ml-sm-0" style="width:15vw">
                <a class="nav-link text-success px-0 py-0" style="font-size:1.5vw" href="#" onclick = "likedthreads()"><i class="fa fa-thumbs-up"></i> Liked Thread</a>
            </div>
        </div>
    </div>
    <!-- End Of Sort By Navigation Bar -->

<!-- Script for hot sort -->
    <script>
        var flag = 0;
        function hotsort(){
            flag = 1;
            $.ajax({
                url:'loadhotsort.php',
                type:'POST',
                success: function(result){
                    $("#threads").html(result);
                    if(type!="admin" && type!="moderator")
{
    var elems =document.getElementsByClassName("delete");
    for (var i=0;i<elems.length;i+=1){
  elems[i].style.display = 'none';
}
                } }

            });
        }
    </script>
<!-- Script End for hot sort -->



    <!-- Main Container Starts Here -->
    <div class="container-fluid">
        <div class="row d-flex justify-content-between">



            <!-- Threads Section Starts Here -->
            <div class="col-8 mt-2 md-8 sm-5 xs-5">

                <div id="threads">

                    <?php
                    include "connection.php";
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
                    /*   <div class="card bg-light"
             style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border:none; ">
             <div class="card-body">
                 <h3><a href="#" style="text-decoration: none;font-size:3.5vw;">THREAD 1</a></h3>
             </div>
             <div class="card-footer  bg-secondary py-0 px-2" style="border:none;">
                 <div class="d-flex justify-content-between">
                     <div class="">
                         <i class="fa fa-eye" style="font-size: 3vw"></i>
                         <h3 class="text-white ml-0" style="display:inline;font-size:3vw">100</h3>
                     </div>
                     <div class="">
                         <i class="fas fa-exclamation-triangle ml-2 text-warning" style="font-size: 3vw"></i>
                         <h3 class="text-white ml-0" style="display:inline;font-size:3vw">10</h3>
                     </div>
                     <div class="">
                         <i class="fa fa-list-ol ml-2 text-info" style="font-size: 3vw"></i>
                         <h3 class="text-white ml-0 " style="display:inline;font-size:3vw">10</h3>
                     </div>
                 </div>
             </div>
         </div>*/


                    ?>

<!--upvote ajax-->

<script>
function updatevote(x){
    var check = x%10;
   if(check == 0){
    var vote_type = "upvote";
   }
   else{
    var vote_type = "downvote";
   }
   
   var id = x;
   id = id/10;
   id = Math.trunc(id);
   var id1 = "#" + x;
$.ajax({

    url: 'updatevote.php',
    type: 'POST',
    data: {id,vote_type},

    success: function(result)
    {
        $(id1).html(result);
    }

});

}
function upvote(x)
{
   var vote_type = "upvote";
   var id = x;
   id = id/10;
   id = Math.trunc(id);
   var y = id + "1";
   var id1 = "#" + x;
$.ajax({

    url: 'vote.php',
    type: 'POST',
    data: {id,vote_type},

    success: function(result)
    {
        $(id1).html(result);
        updatevote(y);
    }

});



}

function downvote(x)
{
   var vote_type = "downvote";
   var id = x;
   id = id/10;
   id = Math.trunc(id);
   var y = id + "0";
   var id1 = "#" + x;
$.ajax({

    url: 'vote.php',
    type: 'POST',
    data: {id,vote_type},

    success: function(result)
    {
        $(id1).html(result);
        updatevote(y);
    }

});

}
</script>
<!-- upvote ajax end -->

<!-- TYPE DISCRIMINATION DELETE BUTTON HIDE-->
<script>
var type = '<?php echo $_SESSION["usertype"]; ?>';
if(type!="admin" && type!="moderator")
{
    var elems =document.getElementsByClassName("delete");
    for (var i=0;i<elems.length;i+=1){
  elems[i].style.display = 'none';
}
}
</script>
<!-- TYPE DISCRIMINATION DELETE BUTTON HIDE END-->

<!--ajax for delete button click-->
<script>
function threaddlt(id)
{
    
    if(confirm("Do you really want to delete this thread?"))
    {
        $.ajax({

url: "threaddlt.php",
type: "POST",
data: {id},
success: function()
{
    document.location.reload(true);
}

});


    }
  

}
</script>
<!-- ajax for delete button click end-->
<!--categories script-->
<script>

function categories(catid)
{
  flag =22;
    $.ajax({
          
          url: "categories.php",
          type: "POST",
          data: {catid},
          success: function(result){
              
            $('#threads').html(result);
                                var type = '<?php echo $_SESSION["usertype"]; ?>';
if(type!="admin" && type!="moderator")
{
    var elems =document.getElementsByClassName("delete");
    for (var i=0;i<elems.length;i+=1){
  elems[i].style.display = 'none';
}
}


          }

  });
}
</script>
<!-- end categories script-->

                </div>
                <button class="btn btn-danger btn-block btn-sm mt-2" onclick="load()" 
                 style="padding:0;"><span style="font-size:2vw">LOAD MORE</span></button>
                <!--SCRIPT FOR BUTTON-->
                <script>
                    var count = 4;
                    function load() {

                        count = count + 2;
                        $.ajax({

                            url: 'load.php',
                            type: 'POST',
                            data: {
                                count,flag
                            },

                            success: function(result) {

                                $('#threads').html(result);
                                var type = '<?php echo $_SESSION["usertype"]; ?>';
if(type!="admin" && type!="moderator")
{
    var elems =document.getElementsByClassName("delete");
    for (var i=0;i<elems.length;i+=1){
  elems[i].style.display = 'none';
}
}

                            }

                        });


                    }
                </script>

                <!--script ends for button-->
            </div>
            <!-- Threads Section Ends Here -->



            <div class="col-4 mt-4 md-4 sm-7 xs-7">



                <!-- Announcements Section Starts Here -->
                <div class="row">
                    <div class="col">
                        <div class="card" style="background:#0f3f7e; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border:none;">
                            <div class="card-body px-1 py-1">
                                <h3 class="text-light text-center" style="font-size:2.5vw;">Announcements</h3>
                                <ul class="list-group">
                                    <?php
                                    include "connection.php";

                                    $sql = "select content from announcement order by time DESC;";
                                    $result = mysqli_query($con, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                            while ($rows = mysqli_fetch_assoc($result)) {
                                                    echo ' <li class="list-group-item list-group-item-light text-center text-danger font-weight-bold nohover px-1 py-2" style="font-size:1.2vw;">
                                     ' . $rows["content"] . '
                                 </li>';
                                                }
                                        }



                                    ?>
                                </ul>
                            </div>
                            <div class="card-footer bg-secondary" style="padding-bottom:2vw;padding-top:0;">
                            </div>
                        </div>
                    </div>
                    <!-- Announcements Section Ends Here -->



                </div>
                <!-- Categories Section Starts Here -->


                <div class="row mt-2">
                    <div class="col">
                        <div class="card" style="background:#0f3f7e; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19); border:none;">
                            <div class="card-body px-1 py-1">
                                <h3 class="text-light text-center" style="font-size:2.5vw;">Categories</h3>
                                <ul class="list-group">
                                <?php
                                      
                                      include "connection.php";
                                      $sql = "select * from category";

                                      $result = mysqli_query($con,$sql);

                                      if(mysqli_num_rows($result)>0)
                                      {
                                          
                                        while($rows = mysqli_fetch_assoc($result))
                                        {

                                            echo ' <li id="'.$rows["cat_id"].'" class="list-group-item cats text-center" onclick="categories(this.id)" style="padding-top:0.5vw;padding-bottom:1vw;"><a href="#"  style="text-decoration: none;font-size:1.8vw;">'.$rows["subject"].'</a></li>';

                                        }
                                      
                                      }


                                ?>
                                    
                                </ul>
                            </div>
                            <div class="card-footer bg-secondary" style="padding-bottom:2vw;padding-top:0;">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Categories Section Ends Here -->





            </div>
        </div>


        <!-- Footer Starts Here -->
            <footer style="font-size:1.5vw;position:absolute;text-align:center;width:96%;padding-top:10vw;margin-bottom:5px">
                  © 2019 Copyright: Netronix
                
            </footer>

        <!-- Footer Ends Here -->


    </div>








    <!-- jquery -->
    <script src="./js/jquery-3.3.1.min.js"></script>
    <!-- bootstrap js-->
    <script src="./js/bootstrap.bundle.min.js"></script>

</body>

</html>