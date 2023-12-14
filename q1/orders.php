<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <!-- Link to the external CSS file for styling -->
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php
    // Start a new or resume the existing session
    session_start();

    // Establish a connection to the MySQL database
    $db = mysqli_connect("127.0.0.1", "root", "password2", "db3");

    // Check if the user is already logged in
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
        // If logged in, display the orders
        displayOrders($db);
    } elseif (isset($_GET['password'])) {
        // If password is submitted, retrieve and compare it with the stored password

        // Retrieve the submitted password from the GET array.
        // This line gets the password that the user entered in the login form.
        $enteredPassword = $_GET['password'];

        // Execute a query on the database to retrieve the stored password.
        // This line sends a query to the MySQL database to get the password from the 'password' table.
        $result = mysqli_query($db, "SELECT pwd FROM password");

        // Fetch the result of the query as an associative array.
        // This line takes the result of the query (which is in a format specific to MySQL) and converts it into a PHP associative array.
        // The 'pwd' field from the database is now accessible in the $row array.
        $row = mysqli_fetch_assoc($result);

        if ($enteredPassword == $row['pwd']) {
            // If password is correct, set session variable and display orders
            $_SESSION['logged_in'] = true;
            displayOrders($db);
        } else {
            // If password is incorrect, display an error message
            echo "Invalid password.";
        }
    } else {
        // If no password submitted and not logged in, request for password
        echo "Password is required.";
    }

    // Function to display all orders from the database
    function displayOrders($db) {
        // Fetch all orders from the database
        $orders = mysqli_query($db, "SELECT * FROM orders");
        // Start a table to display order details
        echo "<table>";

        // Iterate over each order and display its details
        while ($order = mysqli_fetch_assoc($orders)) {
            // Calculate the total cost of each order
            $totalCost = ($order['noodles'] ? 5 : 0) + ($order['rice'] ? 3 : 0) + ($order['hotpot'] ? 10 : 0);

            // Display each order's details in a table row
            echo "<tr><td>";
            echo "ID: " . $order['auto_id'] . "<br>";
            echo "Noodles: " . ($order['noodles'] ? "Yes" : "No") . "<br>";
            echo "Rice: " . ($order['rice'] ? "Yes" : "No") . "<br>";
            echo "Hotpot: " . ($order['hotpot'] ? "Yes" : "No") . "<br>";
            echo "Total Cost: $" . $totalCost . "<br>";
            echo "Name: " . $order['name'] . "<br>";
            echo "Card Number: " . $order['card'] . "<br>";
            echo "Address: " . $order['address'] . "<br>";
            echo "</td></tr>";
        }

        // Close the table
        echo "</table>";

        // Form to complete an order
        echo "<h2>Complete an Order</h2>";
        // The form sends the order ID to 'update.php' using the GET method
        echo "<form action='update.php' method='get'>";
        echo "Order ID to complete: <input type='text' name='order_id'>";
        echo "<input type='submit' value='Complete Order'>";
        echo "</form>";
    }
?>

</body>
</html>

