<?php
session_start();
include("Connect.php");

   


$username=$_POST['username'];
$password=$_POST['password'];


$sql0="SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'";
$resut=mysqli_query($con, $sql0);
if((mysqli_num_rows($resut)>0)){
    $_SESSION["username"]=$username ;
    header( "refresh:0;url=home.php" );

}else {
    
	
		echo "username or password incorrect";
        header( "refresh:1;url=index.php" );

	
   
}