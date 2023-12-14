<?php
// Start the session
session_start();

// Check if 'credits' are passed in the GET request
if(isset($_GET['credits'])) {
    // Store 'credits' in session variable
    $_SESSION['credits'] = $_GET['credits'];
}

// Initialize $status variable. Check if it's set in the session.
$status = isset($_SESSION['status']) ? $_SESSION['status'] : '';
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>Academic Status</title>
    <!-- Include Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <!-- Main container for aligning content to the center -->
    <div class="container mt-5">
        <!-- Page title -->
        <h1 class="text-center mb-4">Select Your Academic Status</h1>

        <!-- Form to select academic status -->
        <form action="state.php" method="get" class="card p-4">
            <!-- Grouping form elements for better visual structure -->
            <div class="form-group">
                <!-- Radio button for selecting 'Undergraduate' status -->
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="undergrad" value="Undergraduate" <?php echo ($status == 'Undergraduate') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="undergrad">
                        Undergraduate
                    </label>
                </div>
                <!-- Radio button for selecting 'Graduate' status -->
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="grad" value="Graduate" <?php echo ($status == 'Graduate') ? 'checked' : ''; ?>>
                    <label class="form-check-label" for="grad">
                        Graduate
                    </label>
                </div>
            </div>
            <!-- Submit button for the form -->
            <button type="submit" class="btn btn-primary">Next</button>
        </form>
    </div>
</body>
</html>
