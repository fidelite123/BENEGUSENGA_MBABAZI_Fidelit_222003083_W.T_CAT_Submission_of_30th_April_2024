<?php

require_once 'db_connection.php';// Establish a connection to the database

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve name and password from the login form
$user_name = $_POST['user_name'];
$password = $_POST['password'];

// Query to check if the user exists in the database
$sql = "SELECT * FROM user WHERE user_name = '$user_name' AND password = '$password'";
$result = $conn->query($sql);

// Check if the query returned any rows (i.e., if the user exists)
if ($result->num_rows > 0) {
    // User exists, redirect to the home page
    header("Location: home.html"); // Change "home.php" to your actual home page
    exit();
} else {
    // User doesn't exist or invalid credentials, redirect back to the login page
    header("Location: login.html"); // Change "login.html" to your actual login page
    exit();
}

// Close the database connection
$conn->close();
?>
