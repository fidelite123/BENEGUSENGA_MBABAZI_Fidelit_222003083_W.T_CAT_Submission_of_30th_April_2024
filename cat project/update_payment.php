<?php
// Connection details
require_once 'db_connection.php';
// Initialize ID variable
$id = null;

// Check if ID is set and form is submitted
if (isset($_GET['updateID']) && isset($_POST['submit'])) {
    
    $id = $_POST['payment_id']; // Get ID from hidden input
    $name = $_POST['payment_name'];
    $date = $_POST['date'];
    $amount = $_POST['payment_amount'];
    $receipt = $_POST['receipt'];
    $user_id = $_POST['user_id'];
    $transaction_id = $_POST['transaction_id'];

    // Prepare and execute the UPDATE statement
    $stmt = $conn->prepare("UPDATE payment SET payment_name=?, date=?, payment_amount=?, receipt=?, user_id=?, transaction_id=? WHERE payment_id=?");
    $stmt->bind_param("ssssssi", $name,  $date, $amount, $receipt, $user_id, $transaction_id, $id);

    if ($stmt->execute()) {
        header('Location: payment.php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updateID'])) {
    $id = $_GET['updateID'];
    $sql_select = "SELECT * FROM payment WHERE payment_id=$id"; // Use $id here instead of $invoice_id
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found for ID: $id";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Head content here -->
</head>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Multicurrency payment system</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css">
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .btn-secondary {
            background-color: #ccc;
            color: #000;
        }

        .btn-secondary:hover {
            background-color: #999;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
        }

    </style>
</head>
<body>
    <div class="container">
        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <h2>Update Payment Details</h2>
        <form method="POST" action="">
            <input type="hidden" name="payment_id" value="<?php echo $id; ?>">
                    
        <div class="form-group">
            <label for="payment_name">Payment Name:</label>
            <input type="text" id="payment_name" name="payment_name" value="<?php echo $row['payment_name']; ?>" required>
            </div>
        
          
          <div class="form-group">
            <label for="date">Date:</label>
            <input type="Date" id="date" name="date"value="<?php echo $row['date']; ?>" required>
          </div>
          <div class="form-group">
            <label for="payment_amount">Payment Amount:</label>
            <input type="number" id="payment_amount" name="payment_amount"value="<?php echo $row['payment_amount']; ?>" required>
          </div>
          <div class="form-group">
            <label for="receipt">Receipt:</label>
            <input type="text" id="receipt" name="receipt"value="<?php echo $row['receipt']; ?>" required>
          </div>
          <div class="form-group">
            <label for="user_id">User Id:</label>
            <input type="number" id="user_id" name="user_id"value="<?php echo $row['user_id']; ?>" required>
          </div>
          <div class="form-group">
            <label for="transaction_id">Transaction Id:</label>
            <input type="number" id="transaction_id" name="transaction_id"value="<?php echo $row['transaction_id']; ?>" required>
          </div>
            
            <div class="form-group">
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
                <a href="payment.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
