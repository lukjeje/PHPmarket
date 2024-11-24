<?php

$host="localhost";
$user="user";
$pass="password";
$db="items";
$conn=new mysqli($host,$user,$pass,$db);
if($conn->connect_error){
    echo "Failed to connect DB".$conn->connect_error;
}

?>