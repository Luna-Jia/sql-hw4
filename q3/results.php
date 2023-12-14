<?php
// Establish a new database connection
$db = mysqli_connect('127.0.0.1', 'root', 'password2', 'db6');

// Retrieve the user's password from the get array
$userPwd = isset($_GET['password']) ? $_GET['password'] : '';

// Execute a query to get the password from the 'password' table
$result = mysqli_query($db, "SELECT pwd FROM password");
$row = mysqli_fetch_assoc($result);
$validPwd = $row['pwd'];

// Compare the entered password with the valid password
if ($userPwd != $validPwd) {
    // Display an error message if the passwords do not match
    echo "Invalid password.";
    exit();
}

// Execute a query to select all rows from the 'students' table
$result = mysqli_query($db, "SELECT * FROM students");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Exam Results</title>
    <!-- Linking Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Exam Results</h1>
        <!-- Bootstrap table for displaying exam results -->
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Passcode</th>
                    <th>Exam Status</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through each student and display their data in the table
                while ($student = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . ($student['name']) . "</td>";
                    echo "<td>" . ($student['code']) . "</td>";
                    echo "<td>" . ($student['complete']) . "</td>";
                    echo "<td>" . ($student['score']) . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
?>

