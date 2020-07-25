
<?php
    session_start();
    include "../forum-connection.php";

    $err="";
    $err1 = "";
    if(isset($_POST['loginbtn'])){

    $username=$_POST["user_name"];
    $password=$_POST["Password"];

    $username=mysqli_real_escape_string($con,$username);
    $password=mysqli_real_escape_string($con,$password);

    //$username=testfunc($username);
    //$password=testfunc($password);
        
    $query="select * from user where username='$username' and password='$password' and active='1'";
    $result=mysqli_query($con,$query);
    $count=mysqli_num_rows($result);
    
    if($count == 1)
    {
      $rows = mysqli_fetch_assoc($result);
      $_SESSION["usertype"] = $rows["type"];
      $_SESSION["user_name"]=$username;
      $_SESSION["password"]=$password;
    
      header("location: home.php");
    }
    else
    {
      $err="Invalid username or password or account is not activated.";
    }
  
}
 
if(isset($_POST['rgrbtn'])){
    $err1 = 0;
    $user_name=$_POST['username'];
    $Password=$_POST['password'];
    $fname=$_POST['fname'];
    $lname=$_POST['lname'];
    $email=$_POST['email'];
    $reg=$_POST['regno'];
    $question=$_POST['squestion'];
    $answer=$_POST['sanswer'];

    $hash = md5( rand(0,1000) );

    /*$query= "SELECT * FROM  user WHERE username = '$username'";
    $result1=mysqli_query($con,$query);
    $query= "SELECT * FROM  user WHERE email = '$email'";
    $result2=mysqli_query($con,$query);
    $query= "SELECT * FROM  user WHERE reg_no = $reg";
    $result3=mysqli_query($con,$query);*/
    
    $user_name=mysqli_real_escape_string($con,$user_name);
    $Password=mysqli_real_escape_string($con,$Password);
    $fname=mysqli_real_escape_string($con,$fname);
    $lname=mysqli_real_escape_string($con,$lname);
    $email=mysqli_real_escape_string($con,$email);
    $reg=mysqli_real_escape_string($con,$reg);
    $answer=mysqli_real_escape_string($con,$answer);
  
  //  $user_name=testfunc($user_name);
   // $Password=testfunc($Password);
   // $fname=testfunc($fname);
    //$lname=testfunc($lname);
   // $email=testfunc($email);
    //$reg=testfunc($reg);

    $query= "INSERT INTO user(username,reg_no,f_name,l_name,email,password,time_created,question,answer,hash) values('$user_name','$reg','$fname','$lname','$email', '$Password',now(),'$question','$answer','$hash')";
    
    $result=mysqli_query($con,$query);
    $err = "Account Created Successfully";
    if(!$result){
       
        die('failed query'. mysqli_error($con));
    }
    
    
    //header("location: index.php");

    $to      = $email; 
  $subject = 'Signup | Email Verification';  
  $message = '
 
Thanks for signing up!
Your account has been created, you can login to your account after activating your account by clicking on the link below.
 
 
Please click this link to activate your account:
https://www.forum.netronixgiki.com/verify.php?email='.$email.'&hash='.$hash.'
 
'; 
                     
$headers = 'From:noreply@gikforum.com' . "\r\n"; 
mail($to, $subject, $message, $headers); 
  
    

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
        <form class="register-form " method="post" action = "index.php">
         <input type="text"  id="fname" name= "fname" placeholder="First Name" required>
         <input type="text"  id="lname" name="lname" placeholder="Last Name" required>
         <input type="text"  id="regno" name="regno" placeholder="Reg Number   eg:20xxxxx" maxlength="7" required>
        <input type="text"  id="username" name="username" placeholder="User Name" maxlength="11" required >
         <input type="email"  id="email" name="email" placeholder="Email   eg:u20xxxxx@giki.edu.pk"  maxlength="20" required>
         
         <select id="squestion" name="squestion" class="browser-default custom-select mb-3" required>
        <option value="">Select Question</option>
        <option value="1">What is your Favorite color?</option>
        <option value="2">What is your pet's name?</option>
        <option value="3">What is your father's name?</option>
        <option value="3">In which city you were born?</option>
        </select>
        
        <input type="text"  id="sanswer" name="sanswer" placeholder="Answer"  maxlength="40" required>
         <input type="password" id="pass"  name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Password must contain at least one number, one uppercase, one lowercase letter and at least 8 characters." required>
         <input type="password" id="cpass" name="confirmpassword" placeholder="Re-enter Password" required>
         <p id='availability'></p>
        <button type="submit" class="btn btn-success" id="registerbtn" name="rgrbtn">Create</button>
       
        <p class="message text-white"><br>Already Registered ? <a href="#">Login Here !</a></p>
        </form>

        <form class="login-form" action="index.php" method="post">
         <input type="text" id="user_name" name="user_name" placeholder="User Name" required>
         <input type="password" id="Password" name="Password" placeholder="Password" required>
          <p class= "<?php if($err != "" && $err !="Account Created Successfully" ) {echo 'alert-danger h6 py-2 mb-0 rounded-sm';} elseif($err == "Account Created Successfully") {echo 'alert-success h6 py-2 mb-0 rounded-sm';}?>"><?php if($err != "") {echo $err;} ?></p>;
         <button type="submit" class="btn btn-success mt-0" id="loginbtn" name="loginbtn">Login</button>
         <p class="message text-white"><br>Not Registered ? <a href="#"><br>Click Here To Register !</a></p>
        

         

        <!--  Forgot password modal Button -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal1">
          Forgot Password?
        </button>

        <button type="button" class="btn btn-primary my-3">
          <a class="text-white" href="guest.php">Enter as Guest</a>
        </button>

        </form>
      </div>
  
  </div>
</div>
        
    </div>

    <!-- The Modal -->
<div class="modal" id="myModal1">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Forgot Password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form  id="forgotform" method="POST">
      <div class="input-group mb-3 form-group">
     
      <div class="input-group-prepend">
      <span class="input-group-text">Username</span>
      </div>
      
      <input type="text" id="frgt" name="forgotusername" class="form-control" required>
      </div>


      
      
      
      </form>
      
      <div class=" justify-content-center" id="uname_response">
      <button type="submit" id="forgotbtn" name="forgotbtn" onclick="check()" class="btn btn-primary">Submit</button>
      </div>
      

      <script>
      
      
      function check()
      {
      var name= document.getElementById("frgt").value;

      $.ajax({

        url: 'forgotpass.php',
            type: 'post',
            data: {name},
            success: function(response){

               
               $("#uname_response").html(response);
                

             }

      });
      }
      </script>
          
      <!--<div class="input-group mb-3 form-group">
      <div class="input-group-prepend">
      <span class="input-group-text">Security Question</span>
      </div>
      <input type="text" name="securityquestion" class="form-control" required>
      </div>

      <div class="input-group mb-3 form-group">
      <div class="input-group-prepend">
      <span class="input-group-text">Answer</span>
      </div>
      <input type="text" name="securityanswer" class="form-control" required>
      </div -->


      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- End of modal -->

    <div class="container-fluid">
    
    <footer class=" footer">
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
var reg = document.getElementById("regno");
var numbers = /^2{1}0{1}[0-9]{5}$/;
var email = document.getElementById("email");
var checkemail = "";

function validate_email(){
  if(email.value != checkemail)
  {
    
    email.setCustomValidity("Invalid Email Or Email Dosent Match Reg No.");

  }
  else
  {
    email.setCustomValidity("");
  }
}

function validateregno()
{
  
  if(!reg.value.match(numbers))
  {
    reg.setCustomValidity("Invalid Format");
  }
  else
  {
    checkemail = "u" + document.getElementById("regno").value + "@giki.edu.pk";
    reg.setCustomValidity("");
  }

 

}


password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;
reg.onkeyup=validateregno;
email.onkeyup = validate_email;

       
      </script>
      <script>
         $('#username').blur(function(){
var username= $(this).val(); 
$.ajax({
  url: "checkattributes.php",
  method: "POST",
  data: {USER_NAME: username},
  dataType: "text",
  success:function(html)
  {
    $('#availability').html(html);
  }


});

});

$('#email').blur(function(){
var email= $(this).val(); 
$.ajax({
  url: "checkattributes.php",
  method: "POST",
  data: {EMAIL: email},
  dataType: "text",
  success:function(html)
  {
    $('#availability').html(html);
  }


});

});

$('#regno').blur(function(){
var regno = $(this).val(); 
$.ajax({
  url: "checkattributes.php",
  method: "POST",
  data: {REGNO: regno},
  dataType: "text",
  success:function(html)
  {
    $('#availability').html(html);
  }


});

});
        </script>

  </body>
</html>