<!DOCTYPE html>
<html>
<head>
    <title>Restaurant Order</title>
    <!-- Bootstrap CSS included for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php
        // Check if 'name' and 'address' cookies are set and retrieve their values
        $name = isset($_COOKIE['name']) ? $_COOKIE['name'] : '';
        $address = isset($_COOKIE['address']) ? $_COOKIE['address'] : '';
    ?>

    <div class="container mt-5">
        <h1 class="text-center">Welcome to Asian Fusion!</h1>

        <!-- Form sending data to customer.php using GET method -->
        <form action="customer.php" method="get" class="mt-4">
            <!-- Input field for Name, pre-filled if cookie is set -->
            <div class="form-group">
                <label>Name:</label>
                <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
            </div>

            <!-- Input field for Address, pre-filled if cookie is set -->
            <div class="form-group">
                <label>Address:</label>
                <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
            </div>

            <!-- Input field for Card Number -->
            <div class="form-group">
                <label>Card Number:</label>
                <input type="text" class="form-control" name="card">
            </div>

            <!-- Checkboxes for food items -->
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="noodles" value="1">
                <label class="form-check-label">Noodles ($5)</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="rice" value="1">
                <label class="form-check-label">Rice ($3)</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="hotpot" value="1">
                <label class="form-check-label">Hotpot ($10)</label>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-primary mt-3">Submit Order</button>
        </form>
    </div>
</body>
</html>
