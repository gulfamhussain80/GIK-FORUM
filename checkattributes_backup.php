<?php
include "connection.php";

$check = 0;

if(isset($_POST['USER_NAME']))
{

  $uname=$_POST['USER_NAME'];
  
   $sql="select * from user where username = '$uname';";
  
   $result=mysqli_query($con,$sql);
   
   if(mysqli_num_rows($result)>0)

   {
    $check=1;
     echo '<span class =" alert-danger h6 py-1 px-4 rounded-sm ">Username Already Exists</span>';
   }
   else
   {
     $check=0;
   }
}
elseif(isset($_POST['EMAIL']))
{
 
  $EMAIL=$_POST['EMAIL'];
 
  
   $sql1="select * from user where email = '$EMAIL';";
  
   $result1=mysqli_query($con,$sql1);
  

  if(mysqli_num_rows($result1)>0)
   {

     echo '<span class =" alert-danger h6 py-1 px-4 rounded-sm ">Email Already Exists</span>';
   }
  
}
if(isset($_POST['REGNO']))
{
 
  $REG=$_POST['REGNO'];
  
   $sql2="select * from user where reg_no = '$REG';";

   $result2=mysqli_query($con,$sql2);
   if(mysqli_num_rows($result2)>0)
   {
     echo '<span class =" alert-danger h6 py-1 px-4 rounded-sm text-center">Reg No. Already Exists</span>';
   }
}

?>