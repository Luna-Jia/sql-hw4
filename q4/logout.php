<?php
// Start a session to access session variables
session_start();

// Check if the user is logged in by verifying the session variable
$loggedIn = isset($_SESSION['userid']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Logout</title>
    <!-- Include Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php if ($loggedIn): ?>
            <?php
                // Retrieve user ID from session
                $userid = $_SESSION['userid'];

                // Establish a database connection
                $db = mysqli_connect('127.0.0.1', 'root', 'password2', 'db7');

                // Get the current time
                $currentTime = date("Y-m-d H:i:s");

                // Update the last visit time and increment the number of visits for the user
                $updateQuery = "UPDATE users SET last = '{$currentTime}', visits = visits + 1 WHERE id = '{$userid}'";
                mysqli_query($db, $updateQuery);

                // Close the database connection
                mysqli_close($db);

                // Destroy the session to log out the user
                session_destroy();
            ?>

            <!-- Display message for successfully logged out users -->
            <div class="alert alert-success">
                <p>You have been successfully logged out.</p>
            </div>
        <?php endif; ?>

        <!-- Login form -->
        <form action="login.php" method="post">
            <h2>Login</h2>
            <div class="form-group">
                <label for="userid">User ID:</label>
                <input type="text" class="form-control" id="userid" name="userid" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="register.html" class="btn btn-secondary">Register</a>
        </form>
    </div>
</body>
</html>
