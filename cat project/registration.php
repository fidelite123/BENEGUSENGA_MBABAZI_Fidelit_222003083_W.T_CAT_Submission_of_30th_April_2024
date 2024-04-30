<?php
require_once 'db_connection.php';

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$user_name = $_POST['user_name'];
$email = $_POST['email'];
$address = $_POST['address'];
$phoneNumber = $_POST['phone_number'];
$gender = $_POST['gender'];
$userCurrency = $_POST['user_currency'];
$password = $_POST['password'];

// Prepare and bind SQL statement
$stmt = $conn->prepare("INSERT INTO user (user_name, email, address, phone_number, gender, user_currency, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $name, $email, $address, $phoneNumber, $gender, $userCurrency, $password);

// Execute the statement
if ($stmt->execute()) {
    // Data inserted successfully, redirect to login page
    header("Location: login.html");
    exit();
} else {
    // Error occurred, display error message
    echo "Error: " . $stmt->error;
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>