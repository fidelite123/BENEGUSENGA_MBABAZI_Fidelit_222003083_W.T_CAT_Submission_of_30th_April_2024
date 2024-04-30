<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Insert Data into Account Table</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    .container {
      width: 50%;
      margin: 0 auto;
      padding: 20px;
    }

    h2 {
      text-align: center;
    }

    label {
      font-weight: bold;
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"] {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
      box-sizing: border-box;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .container {
      width: 80%;
      margin: 0 auto;
      padding: 20px;
    }

    h2 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    th, td {
      padding: 8px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f2f2f2;
    }

    .btn {
      padding: 5px 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .btn-update {
      background-color: #4CAF50;
      color: white;
    }

    .btn-delete {
      background-color: #f44336;
      color: white;
    }

    nav {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 10px 0;
    }

    nav a {
      color: #fff;
      text-decoration: none;
      padding: 10px 20px;
      margin: 0 5px;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    nav a:hover {
      background-color: #555;
    }

    .dropdown {
      position: relative;
      display: inline-block;
    }

    .dropdown-content {
      display: none;
      position: absolute;
      background-color: #f9f9f9;
      min-width: 160px;
      box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
      z-index: 1;
    }

    .dropdown-content a {
      color: black;
      padding: 12px 16px;
      text-decoration: none;
      display: block;
    }

    .dropdown-content a:hover {
      background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
      display: block;
    }

  </style>
</head>
<body>
  <nav>
    <a href="home.html">Home</a>
    <a href="about.html">About Us</a>
    <a href="contact.html">Contact Us</a>
    <a href="service.html">Services</a>
    <a href="updateprofile.html">UpdateProfile</a>
    <div class="dropdown">
      <a href="#" class="dropbtn">Menu</a>
      <div class="dropdown-content">
        <a href="logout.php">Logout</a>
        <a href="payment.html">Payment</a>
        <a href="invoice.html">Invoice</a>
        <a href="account.php">Account</a>
        <a href="Transaction_Currency.html">Transaction Currency</a>
      </div>
    </div>
   
  </nav>
  <div class="container">
    <h2>Insert Data into Account Table</h2>
    <form action="insert_account.php" method="POST">
      <label for="accountName">Account Name:</label>
      <input type="text" id="accountName" name="accountName" required><br>

      <label for="accountType">Account Type:</label>
      <input type="text" id="accountType" name="accountType" required><br>

      <label for="currency">Currency:</label>
      <input type="text" id="currency" name="currency" required><br>

      <label for="balance">Balance:</label>
      <input type="number" id="balance" name="balance" required><br>

      <label for="date">Date:</label>
      <input type="date" id="date" name="date" required><br>

      <label for="userId">User ID:</label>
      <input type="text" id="userId" name="userId" required><br>

      <input type="submit" value="Submit">
    </form>
    <table>
      <tr>
        <th>Account Id</th>
        <th>Account Name</th>
        <th>Account Type</th>
        <th>Currency</th>
        <th>Balance</th>
        <th>Date</th>
        <th>User ID</th>
        <th colspan="">Actions</th>
      </tr>
      <?php
      // PHP code to fetch accounts data from database and display in table
      require_once 'db_connection.php';

      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // SQL query to fetch accounts data
      $sql = "SELECT * FROM account";
      $result = $conn->query($sql);

      // Output data of each row
      while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["account_id"]."</td>";
        echo "<td>".$row["account_name"]."</td>";
        echo "<td>".$row["account_type"]."</td>";
        echo "<td>".$row["currency"]."</td>";
        echo "<td>".$row["balance"]."</td>";
        echo "<td>".$row["date"]."</td>";
        echo "<td>".$row["user_id"]."</td>";
        echo "<td><a href='update_account.php?updateID=" . $row['account_id'] . "'>update  <i class='fas fa-edit'></i></a></td>";
        echo "<td><a href='delete_account.php?ID=" . $row['account_id'] . "'>delete<i class='fas fa-trash'></i></a></td>";
        echo "</tr>";
      }

      $conn->close();
      ?>

    </table>

  </div>
  <!-- Include Bootstrap and Font Awesome JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
