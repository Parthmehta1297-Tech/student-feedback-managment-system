<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch the student's branch and name
$sql_student = "SELECT branch, name FROM students WHERE id=?";
$stmt_student = $conn->prepare($sql_student);
$stmt_student->bind_param("i", $student_id);
$stmt_student->execute();
$result_student = $stmt_student->get_result();
$student = $result_student->fetch_assoc();
$student_branch = htmlspecialchars($student['branch']);
$student_name = htmlspecialchars($student['name']);
$stmt_student->close();

// Fetch faculty who haven't received feedback
$sql_faculty = "
    SELECT * FROM faculty 
    WHERE branch=? 
    AND id NOT IN (SELECT faculty_id FROM feedback WHERE student_id=?)
";
$stmt_faculty = $conn->prepare($sql_faculty);
$stmt_faculty->bind_param("si", $student_branch, $student_id);
$stmt_faculty->execute();
$result_faculty = $stmt_faculty->get_result();

// Check if feedback is completed
$feedback_completed = $result_faculty->num_rows === 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">   
</head>
<body>
    <div class="container">
        <h2 class="welcome-message">Welcome to the Student Feedback System</h2>
        <h3>Hello, <?php echo $student_name; ?>!</h3>
        <h4>Your Branch: <strong><?php echo $student_branch; ?></strong></h4>

        <div class="faculty-list">
            <?php if ($result_faculty->num_rows > 0): ?>
                <?php while ($row = $result_faculty->fetch_assoc()): ?>
                    <div class="faculty-card">
                        <div class="faculty-name"><?php echo htmlspecialchars($row['name']); ?></div>
                        <a href="feedback.php?faculty_id=<?php echo $row['id']; ?>" class="btn-grad">Give Feedback</a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="faculty-card">
                    <a href="download_feedback_pdf.php" class="btn-download">
                        <div class="message1"  style="text-align: center; padding: 20px; font-size: 1em;">
                        <i style="font-size:3em" class="fa">&#xf019;</i>You have completed feedback for all faculty members.
                        </div>
                    </a>
                </div>
            <?php endif; ?>
        </div>
        <br>
        <h3><span style="font-size: 3em; display: inline-block; vertical-align: middle;">&#8593;</span>You can now Download Feedback Report in (PDF) </h3>

        <button class="logout-button">
            <a href="logout.php" class="logout-link">Logout</a>
        </button>
    </div>
</body>
</html>