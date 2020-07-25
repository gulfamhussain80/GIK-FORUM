<?php
include "connection.php";
session_start();

    $uname=$_POST["name"];
    $uname=mysqli_real_escape_string($con,$uname);
    $query="select * from user where username='$uname'";
    $result=mysqli_query($con,$query);

    $count=mysqli_num_rows($result);
    
    if($count == 1)
    {
       $_SESSION['frgtuser']=$uname;
        $query1="select question from user where username='$uname'";
        $result1=mysqli_query($con,$query1);
        $row=mysqli_fetch_assoc($result);
     echo "
     <script>
     document.getElementById('frgt').readOnly=true;
     </script>
     <form id='frgtfrm' method='POST'>
     <div class='input-group mb-3 form-group'>
     <div class='input-group-prepend'>
     <span class='input-group-text'>Question</span>
     </div>
     <input type='text' id='frgtques' name='forgotusername' class='form-control' value='".$row['question']."' readonly>
     
     </div>
     
     <div class='input-group mb-3 form-group'>
      <div class='input-group-prepend'>
      <span class='input-group-text'>Answer</span>
      </div>
      <input type='text' id='answer' name='answer' class='form-control' required>
      </div>
     </form>
      <div class='justify-content-center' id='resp'>
        <button type='submit' name='changepassbtn' onclick='checkyy()' class='btn btn-primary'>Submit</button>
        </div>
     ";
     
     
    }
    else
    {
        echo '
        <div class=" justify-content-center">
        <button type="submit" id="forgotbtn" name="forgotbtn" onclick="check()" class="btn btn-primary">Submit</button>
        </div>';
        echo "Invalid username.";
    }


?>

<script>
      
      
      function checkyy()
      {

      var ans= document.getElementById("answer").value;

      $.ajax({

        url: 'forgotpass1.php',
            type: 'post',
            data: {ans},
            success: function(response){

               
               $("#resp").html(response);
                

             }

      });
      }
      </script>
     