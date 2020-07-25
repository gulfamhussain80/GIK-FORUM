
<?php
    session_start();
    include "connection.php";

    function testfunc($data)
  {
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
  }

    $err="";
    if(isset($_POST['loginbtn'])){

    $username=$_POST["user_name"];
    $password=$_POST["Password"];

    $username=mysqli_real_escape_string($con,$username);
    $password=mysqli_real_escape_string($con,$password);

    $username=testfunc($username);
    $password=testfunc($password);
        
    $query="select * from user where username='$username' and password='$password'";
    $result=mysqli_query($con,$query);
    //if(mysqli_num_rows($result)==1)
    // $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
    //$count=mysqli_num_rows($result);
  
    if(mysqli_num_rows($result) ==1)
    {
    
      $_SESSION["user_name"]=$username;
      $_SESSION["password"]=$password;
      header("location: home.php");
    }
    else
    {
      $err="Invalid username or password.";
    }
  
}
  
 
if(isset($_POST['rgrbtn'])){

    $user_name=$_POST['username'];
    $Password=$_POST['password'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $reg=$_POST['regno'];
    
    $user_name=mysqli_real_escape_string($con,$user_name);
    $Password=mysqli_real_escape_string($con,$Password);
    $fname=mysqli_real_escape_string($con,$fname);
    $lname=mysqli_real_escape_string($con,$lname);
    $email=mysqli_real_escape_string($con,$email);
    $reg=mysqli_real_escape_string($con,$reg);

  //  $user_name=testfunc($user_name);
   // $Password=testfunc($Password);
   // $fname=testfunc($fname);
    //$lname=testfunc($lname);
   // $email=testfunc($email);
    //$reg=testfunc($reg);

    $query= "INSERT INTO user(username,reg_no,f_name,l_name,email,password,time_created) values('$user_name','$reg','$fname','$lname','$email', '$Password',now())";
    
    $result=mysqli_query($con,$query);
    if(!$result){
        die('failed query');
    }
 
    header("location: loginindex.php");


    

}

?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="fontawesome-free-5.8.1-web/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato|Raleway:500,700|Ubuntu" rel="stylesheet">

    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>GIK FORUM</title>
  </head>
  <body>
     
     

    <div class="container login-page">

<div class="row d-flex justify-content-center">
  <div class="col-lg-12 col-md-12 col-sm-10">
  
  
  <div class="form">
          <h1 class=" title display-4 text-white text-center">GIK FORUM</h1>
        <form action="loginindex.php" class="register-form " method="post">
         <input type="text"  id="fname" name= "fname" placeholder="First Name" required>
         <input type="text"  id="lname"name="lname" placeholder="Last Name" required>
         <input type="text"  id="regno"name="regno" placeholder="Reg no." required>
        <input type="text"  id="username" name="username" placeholder="username" required>
         <input type="email"  id="email" name="email" placeholder="Email" required>
         <input type="password" id="pass"  name="password" placeholder="********" required>
         <input type="password" id="cpass" name="confirmpassword" placeholder="*********" required>
        <button type="submit" class="btn btn-success" id="registerbtn" name="rgrbtn">Create</button>
        
        <p class="message text-white">Already Registered? <a href="#">Login</a></p>
        </form>

        <form class="login-form" action="loginindex.php" method="post">
         <input type="text" id="user_name" name="user_name" placeholder="User Name" required>
         <input type="password" id="Password" name="Password" placeholder="*********" required>
          <?php echo "<p class='text-white'>". $err . "</p>"; ?>
         <button type="submit" class="btn btn-success" id="loginbtn" name="loginbtn">Login</button>
         <p class="message text-white">Not Registered? <a href="#">Register</a></p>
        </form>
      </div>
  
  </div>
</div>
        


      

    </div>

    <div class="container-fluid">
    
    <footer class=" footer page-footer)">
      <div class="footer-copyright text-center py-3  text-white">© 2019 Copyright:
        Riaz-ul-Haq | Uzair Ahmed | Muhammad Inam |
         Gulfam Hussain
      </div>
      

      </footer>
    
    </div>

    
    

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="./js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./js/jquery-3.3.1.min.js"></script>
    
   <script>
      $('.message a').click(function(){
       $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
      });
   
       
        var password = document.getElementById("pass"),
            confirm_password = document.getElementById("cpass");

     function validatePassword(){
     if(password.value != confirm_password.value) {
     confirm_password.setCustomValidity("Passwords Don't Match");
    }
    else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
       
      </script>

  </body>
</html>