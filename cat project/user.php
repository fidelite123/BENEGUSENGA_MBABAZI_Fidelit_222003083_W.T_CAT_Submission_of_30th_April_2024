<?php
// Database connection
require_once 'db_connection.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
     switch ($action) {
        // Handle insert operation
        case 'insert':
$user_name = $_POST['user_name'];
$email = $_POST['email'];
$address = $_POST['address'];
$phone_number = $_POST['phone_number'];
$gender = $_POST['gender'];
$user_currency = $_POST['user_currency'];
$password = $_POST['password'];

// Perform data validation
if (empty($user_name) || empty($email) || empty($address) || empty($phone_number) || empty($gender) || empty($user_currency) || empty($password)) {
    echo "All fields are required.";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email format.";

} else {
    // Prepare SQL statement
    $sql = "INSERT INTO user (user_name, email, address, phone_number, gender, user_currency, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    // Create a prepared statement
    $stmt = $conn->prepare($sql);
    
    // Bind parameters
    $stmt->bind_param("sssssss", $user_name, $email, $address, $phone_number, $gender, $user_currency, $password);
    
    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

        case 'update':
            
        // Data validation
$user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
$user_name = isset($_POST['user_name']) ? $_POST['user_name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$phone_number = isset($_POST['phone_number']) ? $_POST['phone_number'] : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$user_currency = isset($_POST['user_currency']) ? $_POST['user_currency'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';

// Validate data (you can add more specific validation as per your requirements)
if (empty($user_id) || empty($user_name) || empty($email) || empty($address) || empty($phone_number) || empty($gender) || empty($user_currency) || empty($password)) {
    echo "All fields are required.";
    exit; // Stop further execution
}

// Prepare SQL statement
$sql = "UPDATE user SET 
        user_name = ?,
        email = ?,
        address = ?,
        phone_number = ?,
        gender = ?,
        user_currency = ?,
        password = ?
        WHERE user_id = ?";

// Create a prepared statement
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo "Error preparing statement: " . $conn->error;
    exit; // Stop further execution
}

// Bind parameters
$stmt->bind_param("sssssssi", $user_name, $email, $address, $phone_number, $gender, $user_currency, $password, $user_id);

// Execute the statement
if ($stmt->execute()) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
}

// Close statement
$stmt->close();

            break;
       case 'delete':
    // Handle delete operation

    // Validate user_id
    $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : '';
    if (!ctype_digit($user_id)) {
        echo "Invalid user ID.";
        break;
    }

    // Prepare SQL statement
    $sql = "DELETE FROM user WHERE user_id = ?";

    // Create a prepared statement
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Error preparing statement: " . $conn->error;
        break;
    }

    // Bind parameter
    $stmt->bind_param("i", $user_id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    // Close statement
    $stmt->close();
    break;

        case 'view':
            // Redirect to the page to display all user details
            header("Location: user.php?action=view");
            exit();
            break;
        default:
            echo "Invalid action";
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'view') {
    // Retrieve all records from the user table
    $sql = "SELECT * FROM user";
    $result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Details</title>
<style>
    /* CSS styling */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #f5f5f5;
    }

    button {
        padding: 5px 10px;
        border: none;
        background-color: #007bff;
        color: white;
        cursor: pointer;
    }

    button:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
    <nav>
    <label class="logo">MULTICURRENCY PAYMENT SYSTEM <br></label>
    <ul>
        <li><a href="home.html">Home</a></li>
        <li><a href="about.html">About us</a></li>
        <li><a href="contact.html">Contact us</a></li>
        <li><a href="service.html">Services</a></li>
        <li><a href="updateprofile.html">Update Profile</a></li>
        <li class="dropdown">
            <a href="#" class="dropbtn">Menu</a>
            <div class="dropdown-content">
                <a href="logout.php">Logout</a>
                <a href="payment.html">Payment</a>
                <a href="invoice.html">Invoice</a>
                <a href="account.php">Account</a>
                <a href="Transaction_Currency.html">Transaction Currency</a>
            </div>
        </li>
    </ul>
</nav>
    <center><form action="search_events" method="GET"><input type="text" name="query" placeholder="search here">
    <button>search</button></form><h2>Table of user</h2></center>
    <table border="5">

    

<h2>User Details</h2>

<table>
    <tr>
        <th>User ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Gender</th>
        <th>User Currency</th>
        <th>Password</th>
        <th>Action</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["user_id"] . "</td>";
            echo "<td>" . $row["user_name"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["address"] . "</td>";
            echo "<td>" . $row["phone_number"] . "</td>";
            echo "<td>" . $row["gender"] . "</td>";
            echo "<td>" . $row["user_currency"] . "</td>";
            echo "<td>" . $row["password"] . "</td>";
            echo "<td>";
            echo "<form method='post' action='user.php'>";
            echo "<input type='hidden' name='user_id' value='" . $row["user_id"] . "'>";
            echo "<input type='hidden' name='action' value='update'>"; // For Update action
            echo "<td>";

// Include hidden input fields for user details
echo "<input type='hidden' name='user_name' value='" . $row["user_name"] . "'>";
echo "<input type='hidden' name='email' value='" . $row["email"] . "'>";
echo "<input type='hidden' name='address' value='" . $row["address"] . "'>";
echo "<input type='hidden' name='phone_number' value='" . $row["phone_number"] . "'>";
echo "<input type='hidden' name='gender' value='" . $row["gender"] . "'>";
echo "<input type='hidden' name='user_currency' value='" . $row["user_currency"] . "'>";
echo "<input type='hidden' name='password' value='" . $row["password"] . "'>";
// Add Update button



            echo "<button type='submit'>Update</button>";
            echo "</form>";
            echo "</td>";
            echo "<td>";
            echo "<form method='post' action='user.php'>";
            echo "<input type='hidden' name='user_id' value='" . $row["user_id"] . "'>";
            echo "<input type='hidden' name='action' value='delete'>"; // For Delete action
            echo "<button type='submit'>Delete</button>";
            echo "</form>";
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='9'>No users found</td></tr>";
    }
    ?>
</table>

</body>
</html>

<?php
}
?>
