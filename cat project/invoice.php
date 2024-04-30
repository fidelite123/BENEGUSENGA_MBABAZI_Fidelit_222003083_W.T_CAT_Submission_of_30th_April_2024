
<?php
// Connection
// Connection
require_once'db_connection.php';
// Insert data if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind the parameters
    $stmt = $conn->prepare("INSERT INTO invoice (invoice_name, invoice_amount, due_date, account_id, transaction_id) VALUES (?,?,?,?,?)");

    // Check if the statement was prepared successfully
    if ($stmt === false) {
        die("Error in preparing statement: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sssss", $name, $amount, $date, $account_id, $transaction_id);

    // Set parameters and execute
    $name = $_POST['invoice_name'];
    $amount = $_POST['invoice_amount'];
    $date = $_POST['due_date'];
    $account_id = $_POST['account_id'];
    $transaction_id = $_POST['transaction_id'];

    if ($stmt->execute()) {
    echo "New record has been added successfully";
} else {
    echo "Error: " . $stmt->error; // Output detailed error message
}


    $stmt->close();
}


// Selecting data from the database
$sql_select = "SELECT * FROM invoice";

// Check if search form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['search'])) {
    $search = $_GET['search'];
    // Add search condition to SQL query
    $sql_select .= " WHERE invoice_name LIKE '%$search%' OR invoice_amount LIKE '%$search%' OR due_date LIKE '%$search%' OR account_id LIKE '%$search%' OR transaction_id LIKE '%$search%'";
}

$result = $conn->query($sql_select);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multicurrency Payment System</title>
    <link rel="stylesheet" href="style.css">
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="
sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap-theme.min.css
" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="
sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<style>
    /* Add your CSS styles here */
    table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
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

    <h2>Invoice  Details</h2>
    <div class="container">
        <?php
        if (isset($_GET['msg'])) {
            $msg = $_GET['msg'];
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">' . $msg . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
        }
        ?>
        <a href="invoice.html" class="btn btn-success">Add New</a>
    </div>
    <br>
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search...">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <table id="dataTable" class="table table-hover text-center">
        <tr>
            <th>invoice_id</th>
            <th>invoice_name</th>
            <th>invoice_amount</th>
            <th>due_date</th>
            <th>account_id</th>
            <th>transaction_id</th>
            <th>Actions</th>
        </tr>
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["invoice_id"] . "</td>";
                echo "<td>" . $row["invoice_name"] . "</td>";
                echo "<td>" . $row["invoice_amount"] . "</td>";
                echo "<td>" . $row["due_date"] . "</td>";
                echo "<td>" . $row["account_id"] . "</td>";
                echo "<td>" . $row["transaction_id"] . "</td>";

                echo "<td>";
                echo "<a href='update_invoice.php?updateID=" . $row['invoice_id'] . "'><i class='fas fa-edit'></i></a>";
                echo "<a href='delete_invoice.php?ID=" . $row['invoice_id'] . "'><i class='fas fa-trash'></i></a>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No data found</td></tr>";
        }
        ?>
   

<?php
// Close connection
$conn->close();
?>
</table>

    <!-- Include Bootstrap and Font Awesome JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

</section><br><br><br>
    <footer>
       
        <p>&copy; 2024 Multicurrency payment system. All rights reserved.</p>
    </footer>
</body>
</html>