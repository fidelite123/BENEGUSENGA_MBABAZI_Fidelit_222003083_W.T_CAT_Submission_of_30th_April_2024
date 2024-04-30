<?php
// Connection details
require_once 'db_connection.php';
// Initialize ID variable
$id = null;

// Check if ID is set and form is submitted
if (isset($_GET['updateID']) && isset($_POST['submit'])) {
    $id = $_POST['transaction_id'];
     $code = $_POST['transaction_code'];
   $rate = $_POST['exchange_rate'];
    $user_id = $_POST['user_id'];
    

    // Prepare and execute the UPDATE statement
    $stmt = $conn->prepare("UPDATE transaction_currency SET transaction_code=?, exchange_rate=?, user_id=? WHERE transaction_id=?");
    $stmt->bind_param("sssi", $code, $rate, $user_id, $id);

    if ($stmt->execute()) {
        header('Location: transaction_currency.php?msg=Record updated successfully');
        exit();
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch existing data for the selected ID
if (isset($_GET['updateID'])) {
    $id = $_GET['updateID'];
    $sql_select = "SELECT * FROM transaction_currency WHERE transaction_id=$id"; // Use $id here instead of $invoice_id
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
        <h2>Update Transaction Currency Details</h2>
        <form method="POST" action="">
            <input type="hidden" name="transaction_id" value="<?php echo $id; ?>">
                    
        <div class="form-group">
            <label for="transaction_code">Transaction Code:</label>
            <input type="text" id="transaction_code" name="transaction_code" value="<?php echo $row['transaction_code']; ?>" required>
            </div>
        <div class="form-group">
            <label for="exchange_rate">Exchange Rate:</label>
            <input type="text" id="exchange_rate" name="exchange_rate"value="<?php echo $row['exchange_rate']; ?>" required>
          </div>
          
         
          <div class="form-group">
            <label for="user_id">User Id:</label>
            <input type="number" id="user_id" name="user_id"value="<?php echo $row['user_id']; ?>" required>
          </div>
            
            <div class="form-group">
                <input type="submit" name="submit" value="Update" class="btn btn-primary">
                <a href="transaction_currency.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
