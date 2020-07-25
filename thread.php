<?php
session_start();
if (!isset($_SESSION["user_name"]) || !isset($_SESSION["password"])) {

        header("location: index.php");
    }

include "connection.php";
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
            background: url("./images/GIKI2.jpg");
            background-size: cover;
            background-position: fixed;
            background-repeat: no-repeat;
        }

        body {
            /* font-family: 'Raleway', sans-serif; */
            font-family: 'Lato', sans-serif;
            /* font-family: 'Ubuntu', sans-serif; */
            margin-bottom: 5px;
        }

        .card-body h3 a {
            color: #235daa;
            transition: color 0.3s, font-size 0.3s, font-weight 0.3s;
        }

        .card-body h3 a:hover {
            color: #0a2a55;
            font-weight: bold;
            font-size: 30px;
        }

        .nohover {
            pointer-events: none;
        }

        .centered {
            float: none;
            margin: 0 auto;


        }
        .nav-link {
            font-size: 1.5rem;
            transition: font-size 0.5s ease-out;
        }

        .nav-link:hover {
            font-size: 1.8rem;
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
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
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



    <div class="container-fluid">





        <!-- Main Container Starts Here -->
        <div class="container-fluid">
            <div class="row d-flex justify-content-between">



                <!-- Threads Section Starts Here -->
                <div class="col">
                    <div class="jumbotron jumbotron-fluid mx-1 p-0 ">
                        <div class="container">
                            <h1 class="text-center text-capitalize" style = "font-size:4vw"><?php echo $_GET["title"]; ?></h1>
                        </div>
                    </div>
                </div>



                <!-- Threads Section Ends Here -->
            </div>

            <div class="row">
                <div class="col" id="posts">

                    <?php

                    $tit = $_GET["title"];
                    $id = $_GET["id"];
                    $_SESSION["id"] = $id;
                    $sql = "select posted_by, posted_on, post_id, content from post where thread_id = $id and status = 0 order by posted_on ASC;";
                    $result = mysqli_query($con, $sql);
                    
                    while ($rows = mysqli_fetch_assoc($result)) {
                         $ID = $rows["post_id"];
                            $nname = $rows["posted_by"];
                            $time = $rows["posted_on"];
                            $content = $rows["content"];
                            $sql1 = "select type from user where username = '$nname';";
                            $result1 = mysqli_query($con, $sql1);
                            $rows1 = mysqli_fetch_assoc($result1);
                            $usertype = $rows1["type"];
                            if($usertype == "normal")
                            {
                            echo ' <section>
                 <div class="container py-3">
                     <div class="card shadow-lg" style="border:none;border-radius:0">
                         <div class="row ">
                             <div class="col-lg-2 bg-dark text-white col-md-2 col-sm-3 col-xs-4 p-lg-0 p-md-0 p-sm-0" style="width:16vw;border-right:1px solid grey">
                                 <i class="fa fa-user fa ml-lg-5 ml-md-5 ml-sm-5 mt-4" style="font-size:7vw"></i>
                                 <p class="ml-md-4 ml-lg-1 ml-sm-1 text-capitalize text-center"id="poster-name" style="font-size:1.5vw">' . $nname . ' <br>' . $time . '</p>
                                 <div class="delete">
                         <i class="fas fa-times fa-2x text-danger" onclick="dltpost('.$ID.','.$id.')" style="font-size:2.8vw;"></i>
                        </div>
                             </div>
                             <div class="col-lg-10 col-md-10 col-sm-9 col-xs-8 px-4" style="width:60vw">
                                 <div class="card-block px-3">
                                    
                                     <p class="lead" style="font-size:1.8vw"> ' . $content . ' </p>
                                  
                                 </div>
                             </div>

                         </div>
                     </div>
                 </div>
         </section>';
                            }
                            else{
                                echo ' <section>
                 <div class="container py-3">
                     <div class="card shadow-lg" style="border:none;border-radius:0">
                         <div class="row ">
                             <div class="col-lg-2 bg-dark text-white col-md-2 col-sm-3 col-xs-4 bg-light p-lg-0 p-md-0 p-sm-0" style="width:16vw;border-right:1px solid grey">
                                 <i class="fa fa-user fa ml-lg-5 ml-md-5 ml-sm-5 mt-4" style="font-size:7vw"></i>
                                 <p class="ml-md-4 ml-lg-0 ml-sm-1 text-capitalize text-center"id="poster-name" style="font-size:1.5vw"><span class = "text-primary text-uppercase">'.$usertype.'</span><br>'.$nname . ' <br>' . $time . '</p>
                                 <div class="delete">
                                 <i class="fas fa-times fa-2x text-danger" onclick="dltpost('.$ID.','.$id.')" style="font-size:2.8vw;"></i>
                                </div>
                             </div>
                             <div class="bg-white text-danger col-lg-10 col-md-10 col-sm-9 col-xs-8 px-4" style="width:60vw">
                                 <div class="card-block px-3">
                                    
                                     <p class="lead" style="font-size:1.8vw"> ' . $content . ' </p>
                                  
                                 </div>
                             </div>

                         </div>
                     </div>
                 </div>
         </section>';

                            }
                        }

                    //ALSO REVERT CHANGES IF NOT WORK ACTION=POST.PHP ad remove php script


                    ?>


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
<!--delete post script here-->
<script>
function dltpost(idd,tid)
{
    if(confirm("Do yo really want to delete this post?"))
    {
        var flag = 1;
    $.ajax({

url: "threaddlt.php",
type: "POST",
data: {idd,flag,tid},
success: function()
{
    document.location.reload(true);
}

});

    }

}
</script>
<!-- delete post script ends here-->
                    <!--THIS IS POST FORM-->
                    <div class="row d-flex">
                        <div class="col-6 centered">
                            <form action="thread.php<?php echo '?title=' . $tit . '&id=' . $id; ?>" method="POST">
                                <div class="form-group">
                                    <label for="comment" style="font-size:4.5vw">Reply</label>
                                    <textarea class="form-control" rows="5" id="comment" name="post-area" required></textarea>
                                </div>
                                <button class="btn btn-success btn-block px-0 py-0" onclick="load()" type="submit"><span style = "font-size:2.5vw">POST</span>   <i class="fas fa-paper-plane" style = "font-size:2.5vw"></i> </button>
                            </form>
                            <script>
                    
                                function load() {
                                    
                                    var tent = $("#comment").val();
                                    
                                    if(tent == ""){
                                      window.alert("Please enter something.");
                                        return;
                                    }
                                    $.ajax({

                                        url: 'loadpost.php',
                                        type: 'POST',
                                        data: {
                                            tent
                                        },

                                        success: function(result) {

                                            $('#posts').html(result);


                                        }

                                    });


                                }
                            </script>


                        </div>
                    </div>


                </div>
            </div>
        </div>
        <!--start of php script for reply post-->
        <?php
        /*
include "../forum-connection.php";

if($_SERVER["REQUEST_METHOD"]=="POST")
{
    $name = $_SESSION["user_name"];
$content = $_POST["post-area"];
$id = $_SESSION["id"];
    include "../forum-connection.php";
    $content = $_POST["post-area"];

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

//USER KA POST COUNT BHI PLUS KARNA HAI
}
*/
        ?>

        <!--end of post script-->
        <!--this is ed of post-->


    </div>


    </div>
    </div>
    </div>


    <!-- Footer Starts Here -->
    <footer style="font-size:1.5vw;position:absolute;text-align:center;width:96%;padding-top:10vw;margin-bottom:5px">
                  © 2019 Copyright:
                    Riaz-ul-Haq | Uzair Ahmed
                    | Muhammad Inam | Gulfam Hussain
                
            </footer>
    <!-- Footer Ends Here -->


    </div>

    </div>



    <!-- jquery -->
    <script src="./js/jquery-3.3.1.min.js"></script>
    <!-- bootstrap js-->
    <script src="./js/bootstrap.bundle.min.js"></script>

</body>

</html>