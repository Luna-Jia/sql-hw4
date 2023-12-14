<?php
// Start the session to access session variables
session_start();

// Retrieve and validate the values from session variables and GET request

// Retrieve the 'credits' value from session; if not set, default to null
$credits = isset($_SESSION['credits']) ? $_SESSION['credits'] : null;

// Retrieve the 'status' value from session; if not set, default to null
$status = isset($_SESSION['status']) ? $_SESSION['status'] : null;

// Retrieve the 'state' value from GET request; if not set, default to null
$state = isset($_GET['state']) ? $_GET['state'] : null;

// Initialize an array to store potential error messages
$errors = [];

// Validate inputs and add error messages if necessary
if ($credits === null || $credits <= 0 || $credits > 18) {
    $errors[] = "Invalid number of credits.";
}
if ($status === null) {
    $errors[] = "Academic status is required.";
}
if ($state === null) {
    $errors[] = "State status is required.";
}

// Proceed with cost calculation if there are no errors
if (empty($errors)) {
    // Determine tuition rate based on academic status
    $tuitionRate = ($status == "Undergraduate") ? 200 : 300;

    // Adjust tuition rate for state status
    $tuitionRate *= ($state == "Instate") ? 1 : 2;

    // Calculate total cost
    $totalCost = $tuitionRate * $credits;

    // Displaying the calculated cost and inputs
    echo "<div class='card p-4'>";
    echo "<p>Credits: $credits</p>";
    echo "<p>Academic Status: $status</p>";
    echo "<p>State Status: $state</p>";
    echo "<p>Total Tuition Cost: \$$totalCost</p>";
    echo "</div>";
} else {
    // Display error messages if validation fails
    echo "<div class='alert alert-danger'>";
    foreach ($errors as $error) {
        echo "<p>$error</p>";
    }
    echo "</div>";
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Tuition Calculation</title>
    <!-- Link to Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <!-- Page title -->
        <h1 class="text-center mb-4">Tuition Calculation</h1>

        <!-- Start Over button to go back to the first page -->
        <div class="text-center mt-4">
            <a href="start.html" class="btn btn-primary">Start Over</a>
        </div>
    </div>

</body>
</html>
