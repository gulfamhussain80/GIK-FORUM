<?php
include "connection.php";
session_start();

    $user=$_SESSION['frgtuser'];
    $ans=$_POST['ans'];
    $query="select * from user where answer='$ans'";
    $result=mysqli_query($con,$query);

    $count=mysqli_num_rows($result);
    
    if($count == 1)
    {
        
     echo "
     <script>
     document.getElementById('answer').readOnly=true;
     </script>
     <form method='post' action='forgotpass1.php'>
     
     <div class='input-group mb-3 form-group'>
      <div class='input-group-prepend'>
      <span class='input-group-text'>New Password</span>
      </div>
      <input type='password' id='npass' name='npass' class='form-control' pattern='(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}' title='Password must contain at least one number, one uppercase, one lowercase letter and at least 8 characters.'  required>
      </div>

      
     <div class='input-group mb-3 form-group'>
     <div class='input-group-prepend'>
     <span class='input-group-text'>Confirm Password</span>
     </div>
     <input type='password' id='cnpass' name='cnpass' class='form-control' required>
     </div>

     
      <div class='justify-content-center'>
        <button type='submit' id='updpassbtn' name='updpassbtn' class='btn btn-primary'>Update Password</button>
        </div>'
        </form>
     ";

     
    }
    else
    {
        echo '
        <div class=" justify-content-center">
        <button type="submit" id="forgotbtn" name="forgotbtn" onclick="checkyy()" class="btn btn-primary">Submit</button>
        </div>';
        echo "Invalid answer.";
    }

    if (isset($_POST['updpassbtn']))
{
    $pass=$_POST['npass'];
    
    $pass=mysqli_real_escape_string($con,$pass);

    $query = "UPDATE user set password = '$pass' where username ='$user'";
    
    $result=mysqli_query($con,$query);
    if(!$result){
       
      die('failed query'. mysqli_error($con));
    }
    header("location: index.php");

}
   

  

?>
<script>

var pass = document.getElementById("npass"),
            confirm_pass = document.getElementById("cnpass");
  var usr=document.getElementById("frgt");

     function validatePassword(){
     if(pass.value != confirm_pass.value) {
     confirm_pass.setCustomValidity("Passwords Don't Match");
    }
    else {
    confirm_pass.setCustomValidity('');
  }
}

pass.onchange = validatePassword;
confirm_pass.onkeyup = validatePassword;

</script>

     