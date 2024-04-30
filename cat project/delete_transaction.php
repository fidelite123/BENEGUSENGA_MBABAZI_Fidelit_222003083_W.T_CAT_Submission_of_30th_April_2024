<?php
// Connection details
require_once'db_connection.php';

// Check if ID is set
if(isset($_REQUEST['ID'])) {
    $id = $_REQUEST['ID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $conn->prepare("DELETE FROM transaction_currency WHERE transaction_id=?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header('location:transaction_currency.php?msg=Delete data successful');
    
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID is not set.";
}

$conn->close();
?>
