<?php 

include 'connect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password=md5($password);

    $checkEmail="SELECT * From users where email='$email'";
     $result=$conn->query($checkEmail);
     if($result->num_rows>0){
        echo "Email Address Already Exists !";
     }
     else{
        $insertQuery="INSERT INTO users(email,password)
                       VALUES ('$email','$password')";
            if($conn->query($insertQuery)==TRUE){
                header("location: /../index.php");
            }
            else{
                echo "Error:".$conn->error;
            }  

     }
     
}

?>