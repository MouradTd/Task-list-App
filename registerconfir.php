<?php
include("Connect.php");

session_start();

   


$username=$_POST['username'];
$email=$_POST['email'];
$password=$_POST['password'];
$confirmpassword=$_POST['confirmpassword'];

$sql0="SELECT * FROM tb_user WHERE username = '$username' OR email = '$email'";
$resut=mysqli_query($con, $sql0);
if(mysqli_num_rows($resut) > 0){
    
    echo"username or email taken";
    header( "refresh:2;url=index.php" );

}

    else{
         if($password == $confirmpassword){
             $sql="insert into tb_user (username,email,password) values ('$username','$email','$password')";
             $insert = mysqli_query($con,$sql);

             if($insert){
                echo "Added Successfully";
                header( "refresh:1;url=index.php" );
            } else {
                // echo mysql_error();
                header( "refresh:1;url=index.php" );

            }
             
         }   
        
         
         
    }
 
