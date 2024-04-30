<?php
// Database connection
require_once'db_connection';
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$accountName = $_POST['accountName'];
$accountType = $_POST['accountType'];
$currency = $_POST['currency'];
$balance = $_POST['balance'];
$date = $_POST['date'];
$userId = $_POST['userId'];

// SQL query to insert data into table
$sql = "INSERT INTO account (account_name, account_type, currency, balance, date, user_id) 
        VALUES ('$accountName', '$accountType', '$currency', '$balance', '$date', '$userId')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
