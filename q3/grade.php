<?php
// Start the session to access session variables
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Grade Report</title>
    <!-- Include Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <?php
        // Check if the user code is set in the session
        if (!isset($_SESSION['userCode'])) {
            echo "<p class='alert alert-danger'>User code not set in the session.</p>";
        } else {
            // Database connection
            $db = mysqli_connect("127.0.0.1", "root", "password2", "db6");

            // Retrieve the user code from the session
            $userCode = $_SESSION['userCode'];

            // Query to retrieve all questions from the 'exam' table
            $query = "SELECT * FROM exam";
            $result = mysqli_query($db, $query);

            // Initialize the score
            $score = 0;

            // Iterate through each question and calculate the score
            while ($row = mysqli_fetch_assoc($result)) {
                $correctAnswer = $row["correct"];
                $questionId = $row["id"];

                // Check if the student's answer (from GET array) matches the correct answer
                if (isset($_GET["q$questionId"]) && $_GET["q$questionId"] == $correctAnswer) {
                    $score++;
                }
            }

            // Update the student's score and completion status
            $updateQuery = "UPDATE students SET score = $score, complete = 'Done' WHERE code = '$userCode'";
           
            echo "<p class='alert alert-success'>Your final score is: $score</p>";
            

        }
        ?>
    </div>
</body>
</html>

