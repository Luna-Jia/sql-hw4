<?php
    // Establishes a connection to the MySQL database using mysqli_connect.
    $db = mysqli_connect("127.0.0.1", "root", "password2", "db3");

    // Retrieves the order ID from the GET request.
    $orderId = $_GET['order_id'];

    // Executes a SQL query to delete the order from the 'orders' table.
    mysqli_query($db, "DELETE FROM orders WHERE auto_id = '$orderId'");

    // Redirects the browser to 'orders.php' to refresh the page and show the updated list of orders.
    header("Location: orders.php");
?>
