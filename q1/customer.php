<?php
    // Start the PHP script.

    // Retrieve name and address from the GET array.
    $name = $_GET['name'] ?? '';
    $address = $_GET['address'] ?? '';

    // Set cookies for the name and address with a 30-day expiration.
    setcookie('name', $name, time() + 60 * 60 * 24 * 30, "/");
    setcookie('address', $address, time() + 60 * 60 * 24 * 30, "/");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <!-- Bootstrap CSS for styling -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <?php
        // Establish a connection to the MySQL database.
        $db = mysqli_connect("127.0.0.1", "root", "password2", "db3");

        // Retrieve the rest of the form data from the GET array.
        $card = $_GET['card'] ?? '';
        $noodles = isset($_GET['noodles']) ? 1 : 0;
        $rice = isset($_GET['rice']) ? 1 : 0;
        $hotpot = isset($_GET['hotpot']) ? 1 : 0;

        // Define the prices for each food item.
        $prices = ['noodles' => 5, 'rice' => 3, 'hotpot' => 10];

        // Calculate the total cost of the order.
        $totalCost = 0;
        if ($noodles) $totalCost += $prices['noodles'];
        if ($rice) $totalCost += $prices['rice'];
        if ($hotpot) $totalCost += $prices['hotpot'];

        // Insert the order details into the database.
        $query = "INSERT INTO orders (name, card, address, noodles, rice, hotpot) VALUES ('$name', '$card', '$address', '$noodles', '$rice', '$hotpot')";
        mysqli_query($db, $query);
    ?>

    <div class='container mt-4'>
        <h1 class='text-center mb-4'>Order Confirmation</h1>
        <table class='table'>
            <!-- Table rows displaying the order details -->
            <tr><th>Name</th><td><?php echo $name; ?></td></tr>
            <tr><th>Card Number</th><td><?php echo $card; ?></td></tr>
            <tr><th>Address</th><td><?php echo $address; ?></td></tr>
            <tr><th>Noodles</th><td><?php echo $noodles ? "Yes ($" . $prices['noodles'] . ")" : "No"; ?></td></tr>
            <tr><th>Rice</th><td><?php echo $rice ? "Yes ($" . $prices['rice'] . ")" : "No"; ?></td></tr>
            <tr><th>Hotpot</th><td><?php echo $hotpot ? "Yes ($" . $prices['hotpot'] . ")" : "No"; ?></td></tr>
            <tr><th>Total Cost</th><td>$<?php echo $totalCost; ?></td></tr>
        </table>
    </div>

</body>
</html>
