<?php
$servername = "localhost";
$username = "Fidelite";
$password = "222003083";
$dbname = "multicurrency_payment_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
