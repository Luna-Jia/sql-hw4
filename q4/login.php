<?php
// Start a session - necessary for maintaining user login state across pages
session_start();

// Initialize a flag to track if the login is valid
$isValidLogin = false;
$name = '';

// Check if the form data is submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data sent from the login form
    $userid = $_POST['userid'];
    $password = $_POST['password'];

    // Connect to the database
    $db = mysqli_connect('127.0.0.1', 'root', 'password2', 'db7');

    // Perform a database query to check user credentials
    // The query checks if there's a user with the given ID and password
    $query = "SELECT name FROM users WHERE id = '{$userid}' AND password = '{$password}'";
    $result = mysqli_query($db, $query); 

    // Check if the query returned any results (i.e., user exists and credentials are valid)
    if (mysqli_num_rows($result) > 0) {
        // User credentials are valid, set the login flag to true
        $isValidLogin = true;

        // Store user ID in the session for later use
        $_SESSION['userid'] = $userid;

        // Fetch the user's name for the welcome message
        $row = mysqli_fetch_assoc($result);
        $name = $row['name'];
    } else {
        // User credentials are invalid, keep the login flag as false
        $isValidLogin = false;
    }

    // Close the database connection
    mysqli_close($db);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <!-- Include Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <?php if ($isValidLogin): ?>
                <!-- Display welcome message if login is valid -->
                <h2>Welcome, <?php echo ($name); ?>!</h2>
                <!-- Navigation buttons for valid login -->
                <a href="home.php" class="btn btn-primary">Home</a>
                <a href="profile.php" class="btn btn-secondary">Profile</a>
                <a href="logout.php" class="btn btn-danger">Logout</a>
            <?php else: ?>
                <!-- Display error message if login is invalid -->
                <div class="alert alert-danger" role="alert">
                    Invalid ID/Password.
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>
