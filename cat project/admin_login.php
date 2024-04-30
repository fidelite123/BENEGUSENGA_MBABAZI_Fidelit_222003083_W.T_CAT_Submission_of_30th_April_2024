<?php
require_once 'db_connection.php';
// Establish a connection to the database

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve name and password from the login form
$email = $_POST['email'];
$password = $_POST['password'];

// Query to check if the user exists in the database
$sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password'";
$result = $conn->query($sql);

// Check if the query returned any rows (i.e., if the user exists)
if ($result->num_rows > 0) {
    // User exists, redirect to the home page
    header("Location: admin_dashboard.html"); 
    exit();
} else {
    // User doesn't exist or invalid credentials, redirect back to the login page
    header("Location: admin_login.html"); 
    exit();
}

// Close the database connection
$conn->close();
?>
