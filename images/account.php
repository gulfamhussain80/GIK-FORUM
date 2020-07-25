<?php

session_start();



if (!isset($_SESSION["user_name"]) || !isset($_SESSION["password"])) {



    header("location: index.php");

}

include "connection.php";

$user = $_SESSION["user_name"];

$sql = "SELECT * from user where username = '$user'";

$result = mysqli_fetch_assoc(mysqli_query($con, $sql));

$fullName = $result["f_name"] . ' ' . $result["l_name"];

$postCount = $result["post_count"];

$err_IncorrectPassword = "<p class=\"alert alert-danger\">Incorrect password.</p><br>";

$err_PasswordUnchanged = "<p class=\"alert alert-danger\">The new password is the same as the old password.</p><br>";

$err_PasswordMismatch = "<p class=\"alert alert-danger\">New password does not match.</p><br>";

$errorLog = '';

$passwordChanged = false;



// Determine Account type

$accountType = $result["type"];

if ($accountType == 'admin') {

    $userBadge = "<span class=\"badge badge-warning\">Administrator</span>";

}

elseif ($accountType == 'moderator') {

    $userBadge = "<span class=\"badge badge-dark\">Moderator</span>";

}

else {

    $userBadge = "<span class=\"badge badge-primary\">Normal</span>";

}



?>





<!DOCTYPE html>



<head>

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

    <meta charset="utf-8">

    <meta name="viewport" content="width = device-width, initial-scale = 1.0, user-scalable = yes">

     <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!--font-awesome-->
    <script src="./js/all.js"></script>

    <link href="/https://fonts.googleapis.com/css?family=Lato|Raleway:500,700|Ubuntu" rel="stylesheet">

    <title>Account Settings</title>

    <script src="/js/jquery-3.3.1.min.js"></script>

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

                        <a class="dropdown-item text-danger" href="index.php">Sign Out</a>

                    </div>

                </li>

            </ul>

         

        </div>

    </nav>

    <!-- End of Main Menu -->



    <div class="card bg-light text-white" style="position:fixed;  width:18%; border-radius:0;">

        <div class="card-body">

            <button id="user-info-btn" class="btn text-dark"

                style="font-size:1.4rem; margin-top:5%; margin-bottom:5%;">User Settings</button>

            <button id="post-summary-btn" class="btn text-dark" style="font-size:1.4rem; margin-bottom:5%;">Post

                Summary</button>

              <!--  <button id="role-mng-btn" class="btn text-dark" style="font-size:1.4rem; margin-bottom:5%;">Manage Roles</button>-->

        </div>

    </div>





    <!-- Account Settings Starts Here -->

    <div id="user-info" class="card container border-primary mb-3"

        style="max-width: 50rem; margin-top:2rem; display:inherit;">

        <div class="card-header">

            <h2>

                <?php

            echo '<p class="text-capitalize">'.$_SESSION['user_name'].'</p>';

        ?>

            </h2>

        </div>

        <div class="card-body">

            <h5 class="card-title">Full Name: <?php echo $fullName; ?></h5>

            <h5 class="card-title">Post Count: <?php echo $postCount; ?></h5>

            <h5 class="card-title">Account type: <?php echo $userBadge; ?></h5>



            <!-- Button trigger modal -->

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#passwordModal">

                Change Password

            </button>



            <!-- Modal -->

            <div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel"

                aria-hidden="true">

                <div class="modal-dialog" role="document">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h5 class="modal-title" id="passwordModalLabel">Change Password</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                <span aria-hidden="true">&times;</span>

                            </button>

                        </div>

                        <?php

                    if (isset($_POST["submit"]) && !empty($_POST)) {

                        $oldPassword = filter_var($_POST["current-password"], FILTER_SANITIZE_STRING);

                        $newPassword = filter_var($_POST["new-password"], FILTER_SANITIZE_STRING);

                        $confirmPassword = filter_var($_POST["confirm-password"], FILTER_SANITIZE_STRING);



                        // Verify correctness of old password

                        if ($oldPassword != $result["password"]) {

                            $errorLog .= $err_IncorrectPassword;

                        }if ($newPassword != $confirmPassword) {

                            $errorLog .= $err_PasswordMismatch;

                        }if ($newPassword === $oldPassword) {

                            $errorLog .= $err_PasswordUnchanged;

                        } 

                        elseif (empty($errorLog)) 

                        {

                            $sql = "UPDATE user SET password = '$newPassword' WHERE username = '$user'";

                            if (mysqli_query($con, $sql)) {

                                $passwordChanged = true;

                                unset($_POST);

                            }

                        }



                        if (!empty($errorLog)) {

                            echo "<script>

                                $(document).ready(function(){

                                    $('#passwordModal').modal('show');

                                    });

                                    </script>";

                            echo $errorLog;

                            $passwordChanged = false;

                            unset($errorLog);

                        }

                    } else {

                        unset($_POST);

                    }

                ?>

                        <div class="modal-body">

                            <form method="post">

                                <div class="form-group">

                                    <label for="current-password">Current Password</label>

                                    <input type="password" class="form-control" name="current-password"

                                        id="current-password" placeholder="Current Password" required>

                                </div>

                                <div class="form-group">

                                    <label for="new-password">New Password</label>

                                    <input type="password" class="form-control" name="new-password" id="new-password"

                                        placeholder="New Password" required>

                                </div>

                                <div class="form-group">

                                    <label for="new-password">Re-enter New Password</label>

                                    <input type="password" class="form-control" name="confirm-password"

                                        id="new-password" placeholder="New Password" required>

                                </div>



                                <div class="modal-footer">

                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                                    <button type="submit" name="submit" class="btn btn-primary">Save changes</button>

                                </div>

                            </form>

                        </div>

                    </div>



                </div>

            </div>

        </div>

        <?php

if ($passwordChanged == true) {

    echo "<p class=\"alert alert-success\">Password changed successfully.</p>";

}

?>

    </div>

    <!-- Account Settings Ends Here -->



    <!-- Post History Starts Here -->

    <!-- Get user post history -->



    <div id="post-summary" class="table-responsive-lg" style="margin:auto; padding:0 20%; display:none;">

        <table class="container-fluid table">

            <tr>

                <th>

                    <h3>Thread Title</h3>

                </th>

                <th>

                    <h3>Upvotes</h3>

                </th>

                <th>

                    <h3>Posted on</h3>

                </th>

            </tr>

            <?php

            $sql = "SELECT title, thread.thread_id as thread_id, up_votes, posted_on from post, thread 

            where posted_by = '$user'

            AND post.thread_id = thread.thread_id AND thread.status=0";

            $result = mysqli_query($con, $sql);



            while ($row = mysqli_fetch_assoc($result)) {

                $title = $row["title"];

                $upvotes = $row["up_votes"];

                $post_time = $row["posted_on"];

                $id = $row["thread_id"];

                echo "<tr>

                        <td><a href=\"thread.php?title=".$title."&id=".$id."\">$title</a></td>

                        <td>$upvotes</td>

                        <td>$post_time</td>

                     </tr>";

            }

        ?>

            <tr>



            </tr>

        </table>

    </div>

    <!-- Post History Ends Here -->

<!-- role management will start here-->





<!-- role management will end here-->

    <!-- Footer Starts Here -->

    <div class="container-fluid">

        <footer class=" footer page-footer)">

            <div class="footer-copyright text-center py-3 text-dark font-weight-bold">© 2019 Copyright:
        Netronix

            </div>

        </footer>

    </div>

    <!-- Footer Ends Here -->

    </div>



    <!-- Script to hide settings -->

    <script>

        document.getElementById("user-info-btn").addEventListener("click", showUserInfo, false);

        document.getElementById("post-summary-btn").addEventListener("click", showPostSummary, false);



        function showPostSummary() {

            var pSummary = document.getElementById('post-summary')

            var p_display = pSummary.style.display;

            pSummary.style.display = "inherit";



            var uInfo = document.getElementById('user-info')

            var u_display = uInfo.style.display;

            uInfo.style.display = "none";

        }

        function showUserInfo() {

            var uInfo = document.getElementById('user-info')

            var u_display = uInfo.style.display;

            uInfo.style.display = "inherit";



            var pSummary = document.getElementById('post-summary')

            var p_display = pSummary.style.display;

            pSummary.style.display = "none";

        }

    </script>



    <!-- Script to prevent form resubmission -->

    <script>

        if (window.history.replaceState) {

            window.history.replaceState(null, null, window.location.href);

        }

    </script>

    <script src="./js/jquery-3.3.1.min.js"></script>

    <!-- bootstrap js-->

    <script src="./js/bootstrap.bundle.min.js"></script>

</body>