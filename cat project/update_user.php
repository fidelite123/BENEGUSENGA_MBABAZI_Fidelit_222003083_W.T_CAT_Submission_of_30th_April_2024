<?php
// Connection details
require_once 'db_connection.php';

// Check if user_id is set
if(isset($_REQUEST['user_id'])) {
    $user_id = $_REQUEST['user_id'];
    
    // Prepare and execute SELECT statement to retrieve user details
    $stmt = $connection->prepare("SELECT * FROM user WHERE user_id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $user_name = $row['user_name'];
        $email = $row['email'];
        $address = $row['address'];
        $phone_number = $row['phone_number'];
        $gender = $row['gender'];
        $user_currency = $row['user_currency'];
        $password = $row['password'];
    } else {
        echo "User not found.";
    }
}

?>

<html>
<body>
    <form method="POST">
        <label for="fname">User Name:</label>
        <input type="text" name="user_name" value="<?php echo isset($user_name) ? $user_name : ''; ?>">
        <br><br>

        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        <br><br>
        
        <label for="address">Address:</label>
        <input type="text" name="address" value="<?php echo isset($address) ? $address : ''; ?>">
        <br><br>
        
        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" value="<?php echo isset($phone_number) ? $phone_number : ''; ?>">
        <br><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender">
            <option value="male" <?php if(isset($gender) && $gender == 'male') echo 'selected'; ?>>Male</option>
            <option value="female" <?php if(isset($gender) && $gender == 'female') echo 'selected'; ?>>Female</option>
            <option value="other" <?php if(isset($gender) && $gender == 'other') echo 'selected'; ?>>Other</option>
        </select><br><br>
        
        <label for="user_currency">User Currency:</label>
        <input type="text" name="user_currency" value="<?php echo isset($user_currency) ? $user_currency : ''; ?>">
        <br><br>
        
        <label for="password">Password:</label>
        <input type="text" name="password" value="<?php echo isset($password) ? $password : ''; ?>">
        <br><br>
       
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $user_name = $_POST['user_name'];
    $email = $_POST['email'];    
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $gender = $_POST['gender'];
    $user_currency = $_POST['user_currency'];
    $password = $_POST['password'];
    
    // Update the table in the database
    $stmt = $connection->prepare("UPDATE user SET user_name=?, email=?, address=?, phone_number=?, gender=?, user_currency=?, password=? WHERE user_id=?");
    $stmt->bind_param("sssssssi", $user_name, $email, $address, $phone_number, $gender, $user_currency, $password, $user_id);
    
    if ($stmt->execute()) {
        // Redirect to user.php after successful update
        header('Location: user.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating user: " . $stmt->error;
    }
}
?>
