<?php
// Set the default time zone to Detroit's time zone
date_default_timezone_set('America/Detroit');

// Establish database connection
$db = mysqli_connect("127.0.0.1", "root", "password2", "db6");

// Retrieve user code from GET request
$userCode = isset($_GET['code']) ? $_GET['code'] : '';

// Query to find student with the given code
$query = "SELECT * FROM students WHERE code = '$userCode'";
$result = mysqli_query($db, $query); // Execute the query

// Initialize flags for user found and completion status
$userFound = false;
$alreadyCompleted = false;

// Check if the student exists
if ($result && mysqli_num_rows($result) > 0) {
    $userFound = true;
    $student = mysqli_fetch_assoc($result); // Fetch the student's data

    // Check if the student has already seen or completed the exam
    if ($student['seen'] == 'Done' || $student['complete'] == 'Done') {
        $alreadyCompleted = true;
    } else {
        // Start a new session and set user code and CURRENT start time
        session_start();
        $_SESSION['userCode'] = $userCode;
        $_SESSION['startTime'] = time(); // Set current time as start time

        // Update student's status to 'seen'
        $updateQuery = "UPDATE students SET seen = 'Done' WHERE code = '$userCode'";
        mysqli_query($db, $updateQuery); // Execute the update query
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Exam</title>
    <!-- Bootstrap CSS for styling -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center">Exam</h1>
        <?php
        // Display messages based on user status
        if (!$userFound) {
            // If user code is not found
            echo "<p class='alert alert-danger'>Invalid passcode.</p>";
        } elseif ($alreadyCompleted) {
            // If user has already seen or completed the exam
            echo "<p class='alert alert-warning'>You have already seen or completed the exam.</p>";
        } else {
            // Fetch exam questions
            $questionQuery = "SELECT * FROM exam";
            $questionResult = mysqli_query($db, $questionQuery); // Execute the query
            $numQuestions = mysqli_num_rows($questionResult); // Get the number of questions

            // Dynamically create the exam form
            echo '<form action="grade.php" method="get">';
            while ($question = mysqli_fetch_assoc($questionResult)) {
                // Display each question and its answers
                echo "<div class='mb-3'>";
                echo "<p>" . htmlspecialchars($question['question']) . "</p>";

                for ($i = 1; $i <= 4; $i++) {
                    // Display radio buttons for answers
                    echo '<div class="form-check">';
                    echo '<input class="form-check-input" type="radio" name="q' . $question['id'] . '" value="' . $i . '">';
                    echo '<label class="form-check-label">' . ($question['answer' . $i]) . '</label>';
                    echo '</div>';
                }
                echo "</div>";
            }

            // Calculate and display exam duration and start time
            $examDuration = $numQuestions * 60; // Calculate exam duration (60 seconds per question)
            $_SESSION['duration'] = $examDuration; // Store duration in session
            echo "<p>Exam Start Time: " . date("H:i:s", $_SESSION['startTime']) . "</p>";
            echo "<p>Duration: " . ($examDuration / 60) . " minutes</p>";

            // Submit button for the exam
            echo '<button type="submit" class="btn btn-primary mb-4">Submit Exam</button>';
            echo '</form>';
        }
        ?>

    </div>
</body>
</html>
