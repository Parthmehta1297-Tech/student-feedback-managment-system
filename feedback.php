<?php
session_start();
include 'db.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch the student's branch and name
$sql_student = "SELECT branch, name FROM students WHERE id='$student_id'";
$result_student = $conn->query($sql_student);
$student = $result_student->fetch_assoc();
$student_branch = $student['branch'];
$student_name = $student['name'];

// Fetch faculty members from the same branch, excluding those for whom feedback has already been given
$sql_faculty = "
    SELECT * FROM faculty 
    WHERE branch='$student_branch' 
    AND id NOT IN (SELECT faculty_id FROM feedback WHERE student_id='$student_id')
";
$result_faculty = $conn->query($sql_faculty);

// Initialize faculty variable
$faculty = null;

// Check if any faculty members are available
if ($result_faculty->num_rows > 0) {
    $faculty = $result_faculty->fetch_assoc(); // Fetch the first faculty member
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $faculty_id = $_POST['faculty_id']; // Assuming you pass faculty_id in the form
    $college_rating = $_POST['college_rating'];
    $faculty_rating = $_POST['faculty_rating'];
    $description = $_POST['description'];

    // Insert feedback into the database
    $sql_insert = "INSERT INTO feedback (student_id, faculty_id, college_rating, faculty_rating, description, student_name) VALUES ('$student_id', '$faculty_id', '$college_rating', '$faculty_rating', '$description', '$student_name')";
    if ($conn->query($sql_insert) === TRUE) {
        header("Location: already_submitted.php");
        exit();
    } else {
        $message = "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style3.css">
    <title>Feedback</title>
    
</head>
<body>
    <div class="container">
        <?php if ($faculty): ?>
            <h2>Feedback for <?php echo htmlspecialchars($faculty['name']); ?></h2>
            <form method="POST">
                <input type="hidden" name="faculty_id" value="<?php echo htmlspecialchars($faculty['id']); ?>">
                <label for="college_rating">Rate College:</label>
                <div class="smiley-rating">
                    <span class="smiley" data-value="1" onclick="selectRating('college', 1)">😡</span>
                    <span class="smiley" data-value="2" onclick="selectRating('college', 2)">🙁</span>
                    <span class="smiley" data-value="3" onclick="selectRating('college', 3)">😐</span>
                    <span class="smiley" data-value="4" onclick="selectRating('college', 4)">🙂</span>
                    <span class="smiley" data-value="5" onclick="selectRating('college', 5)">😊</span>
                </div>
                <input type="hidden" name="college_rating" id="college_rating" required>
                <div class="comment" id="college_comment"></div>

                <label for="faculty_rating">Rate Faculty:</label>
                <div class="smiley-rating">
                    <span class="smiley" data-value="1" onclick="selectRating('faculty', 1)">😡</span>
                    <span class="smiley" data-value="2" onclick="selectRating('faculty', 2)">🙁</span>
                    <span class="smiley" data-value="3" onclick="selectRating('faculty', 3)">😐</span>
                    <span class="smiley" data-value="4" onclick="selectRating('faculty', 4)">🙂</span>
                    <span class="smiley" data-value="5" onclick="selectRating('faculty', 5)">😊</span>
                </div>
                <input type="hidden" name="faculty_rating" id="faculty_rating" required>
                <div class="comment" id="faculty_comment"></div>

                <div id="selected_comments">
                    <div class="greeting" id="greeting_message"></div>
                </div>

                <label for="description">Additional Comments:</label>
                <textarea id="description" name="description" rows="4" placeholder="Your comments here..." required></textarea>

                <button type="submit" class="btn-grad">Submit Feedback</button>
            </form>
        <?php else: ?>
            <h2>No Faculty Available for Feedback</h2>
            <p>It seems that you have already provided feedback for all faculty members in your branch.</p>
        <?php endif; ?>
        <div class="message"><?php if (isset($message)) { echo $message; } ?></div>
        <a href="dashboard.php" class="btn-grad">Back to Dashboard</a>
    </div>

    <script>
        function selectRating(type, value) {
            document.getElementById(type + '_rating').value = value;
            const smileys = document.querySelectorAll('.smiley-rating span');
            smileys.forEach(smiley => {
                if (smiley.dataset.value <= value) {
                    smiley.classList.add('selected');
                } else {
                    smiley.classList.remove('selected');
                }
            });
            const commentElement = document.getElementById(type + '_comment');
            commentElement.innerText = "You rated " + (type === 'college' ? "College" : "Faculty") + " " + value + " stars.";

            // Display greeting based on rating
            const greetingMessage = document.getElementById('greeting_message');
            if (value === 5 ) {
                greetingMessage.innerText = "Excellent!";
            } else if (value === 1) {
                greetingMessage.innerText = "Very Poor!";
            } else {
                greetingMessage.innerText = "";
            }
        }
    </script>
</body>
</html>