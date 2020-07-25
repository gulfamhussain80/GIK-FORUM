<?php
session_start();


if (!isset($_SESSION["user_name"]) && !isset($_SESSION['usertype'])) {

    header("location: index.php");
}





include "connection.php";

if(isset($_POST['btnSubmit'])){

    $email=$_POST['txtEmail'];
    $message=$_POST['txtMsg'];
    $message.=' '.$email;
    $phone=$_POST['txtPhone'];
    if($_SESSION['usertype']=="guest")
    {
        $username="guest";
    }
    else{

    
    $username=$_SESSION['user_name'];  //later has to be changed. user name will be obtained from session.//
    }
    
    function testfunc($data)
    {
      $data=trim($data);
      $data=stripslashes($data);
      $data=htmlspecialchars($data);
      return $data;
    }
    

    $message=mysqli_real_escape_string($con,$message);
    $phone=mysqli_real_escape_string($con,$phone);
    $username=mysqli_real_escape_string($con,$username);
    $to="u2017280@giki.edu.pk";
    $subject="GIK FORUM CONTACT US";
    echo $email;
    $headers = 'From:gikforumcontact@gikiforum.com'. "\r\n"; 
    mail($to,$subject,$message,$headers);
    
    //$message=testfunc($message);
    //$phone=testfunc($phone);
    //$username=testfunc($username);

    $query= "insert into contactus(username,phone,message) values('$username','$phone','$message')";

    
    $result=mysqli_query($con,$query);

    if(!$result){
        die('failed query');
    }
    
      
    
 
    header("location: contact.php");
    
}




?>

<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width = device-width, initial-scale = 1.0, user-scalable = yes">
    <script src="./js/all.js"></script>
    <link href="./css/contactstyle.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <title>Contact Us</title>
    <style>
        .header {
            background: url("images/GIKI2.jpg");
            background-size: cover;
            background-position:fixed;
            background-repeat: no-repeat;
        }
        body{
            font-family:sans-serif;
        }
    </style>
    

</head>


<body>
    <div class="container-fluid" style="margin-bottom: 0;">
        <!-- header -->
        <div class="row header pb-3 pt-0">
            <div class="col">
                <h1 class="display-3 font-weight-bold">GIK <span style="color:#062b5c;font-weight: lighter">Forum</span>
                </h1>
            </div>
        </div>
        <!-- end header -->
    </div>
    <nav class="navbar navbar-expand-lg navbar-light" style="background:#0f3f7e">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link text-white" <?php if($_SESSION['usertype']=='guest'){echo "href='guest.php'";}else{ echo "href='home.php'";} ?>><i class="fa fa-home mr-2"></i>Home <span
                            class="sr-only">(current)</span></a>
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
    

    <div class="d-flex justify-content-center mb-5">
    <div class=" contactdiv container align-items-center contact-form my-3 mx-5">
            <div class="contact-image">
                <img src="./css/images/contact.png" alt="rocket_contact"/>
            </div>
            <form method="post">
                <h3 class="text-white">Drop Us a Message</h3>
               <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="txtName" class="form-control" placeholder="Your Name *" value="" required />
                        </div>
                        <div class="form-group">
                            <input type="email" name="txtEmail" class="form-control" placeholder="Your Email *" value="" required />
                        </div>
                        <div class="form-group">
                            <input type="text" name="txtPhone" class="form-control" placeholder="Your Phone Number *" value="" required />
                        </div>
                        <!-- -->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <textarea name="txtMsg" class="form-control" placeholder="Your Message *" required style="width: 100%; height: 150px;"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="btnSubmit" class="btn btnContact" value="Send Message" />
                        </div>
                    </div>
                </div>
            </form>
</div>


</div>

<div class="container-fluid">
    
<footer style="font-size:1.5vw;position:absolute;text-align:center;width:96%;padding-top:10vw;margin-bottom:5px">
                  © 2019 Copyright:
                    Netronix
                
            </footer>
    
    </div>

    <script src="./js/jquery-3.3.1.min.js"></script>
    <!-- bootstrap js-->
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/jquery-3.3.1.min.js"></script>
   
</body>