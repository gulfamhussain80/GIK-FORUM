<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About us</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!--font-awesome-->
    <script src="./js/all.js"></script>

    <!-- main css-->
    <style>
    
    .card-img-top {
width: 100%;
height: 40vh;
object-fit: cover;
}
    
        .header {
            background: url("images/GIKI2.jpg");
            background-size: cover;
            background-position: fixed;
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

        .card p {
            margin: 0px;
        }

        .card-header h3 a {
            color: #235daa;
            transition: color 0.5s ease-in-out, font-size 0.5s ease-in-out, font-weight 0.5s ease-in-out;
        }

        .card-header h3 a:hover {
            color: #0a2a55;
            font-weight: bold;
            font-size: 3vw;
        }

        #thumbsup {
            font-size: 3vw;
        }

        .nohover {
            pointer-events: none;
        }

        #thumbsup:hover {
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
                    <a class="nav-link text-white"
                        <?php if($_SESSION['usertype']=='guest'){echo "href='guest.php'";}else{ echo "href='home.php'";} ?>><i
                            class="fa fa-home mr-2"></i>Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="contact.php">Contact Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="aboutus.php">About Us</a>
                </li>
                <?php if($_SESSION['usertype']!="guest")
{
    echo '<li class="nav-item dropdown" id="spec">
    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Account
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item " href="account.php">Settings</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item text-danger" onclick="des()" href="index.php">Sign Out</a>
    </div>
</li>' ;

}
else{
    echo ' <li class="nav-item">
    <a class="nav-link text-danger" href="index.php">Login/Sign Up</a>
</li>';
}
?>



            </ul>
           
        </div>
    </nav>
    <!-- End of Main Menu -->




 


    <div class="jumbotron">
        <h1 class="display-3 text-center">Founders</h1>
        <!-- <p class="lead text-center">RANDOM MESSAGE </p> -->

    </div>


    <div class="container">

    

    <div class="row my-4">
        <div class="col">

       
        <div class="card " style="width: 15.7rem;">
            <img class=" img card-img-top img-fluid"  src="images/uzair.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Uzair Ahmed</h5>
                <p class="card-text">Batch 27</p>
                <p class="card-text">Faculty CS</p>

            </div>
        </div>

    </div>

    <div class="col">
        <div class="card " style="width: 15.7rem;">
            <img class=" img card-img-top img-fluid"  src="images/gulfam.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Gulfam Hussain</h5>
                <p class="card-text">Batch 27</p>
                <p class="card-text">Faculty CS</p>

            </div>
        </div>
    </div>

<div class="col">
    

        <div class="card " style="width: 15.7rem;">
            <img class="img card-img-top img-fluid" src="images/riaz.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Muhammad Riaz</h5>
                <p class="card-text">Batch 27</p>
                <p class="card-text">Faculty CS</p>

            </div>
        </div>
    </div>


    <div class="col">

    
        <div class="card " style="width: 15.7rem;">
            <img class=" img card-img-top img-fluid" src="images/inam.jpg" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title">Muhammad Inam</h5>
                <p class="card-text">Batch 27</p>
                <p class="card-text">Faculty CS</p>

            </div>
        </div>
    </div>

    </div>

    
</div>

    <div class="d-flex justify-content-center">
        <h3 class="mt-3 font-weight-bold">Currently being managed and handled by Netronix GIKI</h3>
    </div>
    <!--PHP SCRIPT-->



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