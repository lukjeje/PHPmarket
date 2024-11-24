<?php

include 'connect.php';


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

    
    $sql="SELECT * FROM users WHERE email='$email' and password='$password'";
    $result=$conn->query($sql);
    if($result->num_rows>0){

      require_once 'config.php';
       session_start();
       $_SESSION["email"] = $email;
       header("Location: /../cart.php");
       exit();
       
    }
    else{
     echo "Not Found, Incorrect Email or Password";
    }
 
 }

?>