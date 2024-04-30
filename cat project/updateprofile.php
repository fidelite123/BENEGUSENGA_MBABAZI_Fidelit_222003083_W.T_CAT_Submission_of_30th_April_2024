<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.html");
    exit();
}
$connection = new mysqli("localhost", "root", "", "mytest");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

$user_id=$_SESSION['userid'];
if ($_SERVER["REQUEST_METHOD"]=="POST") {
   $firstname=$_POST['firstname'];
   $lastname=$_POST['lastname'];


   
   $sql = "INSERT INTO user (user_name, email, address, phone_number, gender, user_currency, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
   if ($connection->query($sql) ==TRUE) {
       echo"PROFILE updated successfully";
       header("Location:login.html");
   }else{
    echo "error updating  profile:".$connection->error;
   }
}
$connection->close();

?>