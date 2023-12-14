<?php

// Directly establish a connection to the database using mysqli_connect
$db = mysqli_connect('127.0.0.1', 'root', 'password2', 'db7');

// Check if the data is submitted via GET method
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Retrieve form data using GET method
    $userid = $_GET['userid'];
    $password = $_GET['password']; 
    $name = $_GET['name'];
    $email = $_GET['email'];

    // Check if the user ID already exists
    $sql = "SELECT id FROM users WHERE id = '$userid'";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) > 0) {
        // User ID exists, display an error message
        echo "<div class='alert alert-danger' role='alert'>
                Invalid ID - User already exists.
              </div>";
    } else {
        // User ID does not exist, proceed to insert new user
        $insert_sql = "INSERT INTO users (id, password, name, email, visits, last) VALUES ('$userid', '$password', '$name', '$email', 0, NOW())";
        
        if (mysqli_query($db, $insert_sql) === TRUE) {
            // Successful insert, display confirmation
            echo "<div class='alert alert-success' role='alert'>
                    Registration successful!
                  </div>
                  <a href='login.html' class='btn btn-primary'>Go to Login</a>";
        } else {
            // Display an error if the query failed
            echo "Error: " . $insert_sql . "<br>" . mysqli_error($db);
        }
    }

    // Close database connection
    mysqli_close($db);
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <!-- Content here -->
    </div>
</body>
</html>
