<?php
// Start the session
session_start();

// Check if 'state' is passed in the GET request and store it in session
if(isset($_GET['state'])) {
    $_SESSION['state'] = $_GET['state'];
}

// Initialize 'state' variable with the value from session if set
$state = isset($_SESSION['state']) ? $_SESSION['state'] : '';
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>State Status</title>
    <!-- Include Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Main container for aligning content to the center -->
    <div class="container mt-5">
        <!-- Page title -->
        <h1 class="text-center mb-4">Select Your State Status</h1>

        <!-- Form to select state status -->
        <form action="calculate.php" method="get" class="card p-4">
            <!-- Grouping form elements for better visual structure -->
            <div class="form-group">
                <!-- Radio button for selecting 'In-state' status -->
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="state" id="instate" value="Instate" <?php echo ($state == 'Instate') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="instate">
                        In-state
                    </label>
                </div>
                <!-- Radio button for selecting 'Out-of-state' status -->
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="state" id="outstate" value="Out-of-state" <?php echo ($state == 'Out-of-state') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="outstate">
                        Out-of-state
                    </label>
                </div>
            </div>
            <!-- Submit button for the form -->
            <button type="submit" class="btn btn-primary">Next</button>
        </form>
    </div>
</body>
</html>
