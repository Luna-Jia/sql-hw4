<?php
// Start a session to access session variables
session_start();

// Check if the user is logged in by verifying the session variable
$loggedIn = isset($_SESSION['userid']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <!-- Bootstrap CSS  -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php if ($loggedIn): ?>
            <?php
                // Retrieve user ID from the session
                $userid = $_SESSION['userid'];

                // Establish a database connection using mysqli_connect
                $db = mysqli_connect('127.0.0.1', 'root', 'password2', 'db7');

                // Fetch the user's name from the database
                $query = "SELECT name FROM users WHERE id = '{$userid}'";
                $result = mysqli_query($db, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                    // Retrieve the name from the database query result
                    $row = mysqli_fetch_assoc($result);
                    $name = $row['name'];
                } else {
                    // Handle the case where the user is not found in the database
                    echo "User not found.";
                    exit;
                }

                // Close the database connection
                mysqli_close($db);
            ?>

            <!-- Display a personalized welcome message for the logged-in user -->
            <h2>Welcome, <?php echo ($name); ?>!</h2>

            <!-- Navigation buttons for different pages -->
            <a href="home.php" class="btn btn-primary">Home</a>
            <a href="profile.php" class="btn btn-secondary">Profile</a>
            <a href="logout.php" class="btn btn-danger">Logout</a>
        <?php else: ?>
            <!-- Display a message for users who are not logged in with a link to the login page -->
            <div class="alert alert-warning">
                <p>You are not logged in. Please <a href="login.html">click here</a> to log in.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
