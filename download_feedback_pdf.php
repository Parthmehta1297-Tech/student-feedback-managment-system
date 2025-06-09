<?php
session_start();
require_once 'db.php';
require_once 'tcpdf/tcpdf.php';

if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

$sql_student = "SELECT name, branch FROM students WHERE id=?";
$stmt_student = $conn->prepare($sql_student);
$stmt_student->bind_param("i", $student_id);
$stmt_student->execute();
$result_student = $stmt_student->get_result();
$student = $result_student->fetch_assoc();
$student_name = htmlspecialchars($student['name']);
$student_branch = htmlspecialchars($student['branch']);
$stmt_student->close();

$sql_feedback = "
    SELECT faculty.name AS faculty_name, feedback.faculty_rating, feedback.college_rating, feedback.description, feedback.created_at
    FROM feedback 
    INNER JOIN faculty ON feedback.faculty_id = faculty.id 
    WHERE feedback.student_id = ?
";
$stmt_feedback = $conn->prepare($sql_feedback);
$stmt_feedback->bind_param("i", $student_id);
$stmt_feedback->execute();
$result_feedback = $stmt_feedback->get_result();

$pdf = new TCPDF();
$pdf->SetMargins(15, 10, 15);
$pdf->AddPage();
$pdf->Image('image.jpg', 10, 5, 190, 30);
$pdf->Ln(35);

$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(190, 10, 'The Feedback Which you have given ', 0, 1, 'C');

$pdf->SetFont('helvetica', '', 12);
$pdf->Cell(190, 8, "Student Name: $student_name | Branch: $student_branch", 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->SetFillColor(230, 230, 250);
$pdf->Cell(50, 10, 'Faculty Name', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Faculty Rating', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'College Rating', 1, 0, 'C', true);
$pdf->Cell(50, 10, 'Description', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Date', 1, 1, 'C', true);

$pdf->SetFont('helvetica', '', 11);
$index = 0;
while ($row = $result_feedback->fetch_assoc()) {
    $faculty_name = htmlspecialchars($row['faculty_name']);
    $faculty_rating = htmlspecialchars($row['faculty_rating']);
    $college_rating = htmlspecialchars($row['college_rating']);
    $description = htmlspecialchars($row['description']);
    $created_at = date("d M Y", strtotime($row['created_at']));
    $rowFill = ($index % 2 == 0) ? 255 : 245;

    $pdf->SetFillColor($rowFill, $rowFill, $rowFill);
    $pdf->Cell(50, 10, $faculty_name, 1, 0, 'C', true);
    $pdf->Cell(30, 10, $faculty_rating, 1, 0, 'C', true);
    $pdf->Cell(30, 10, $college_rating, 1, 0, 'C', true);
    $pdf->Cell(50, 10, $description, 1, 0, 'C', true);
    $pdf->Cell(30, 10, $created_at, 1, 1, 'C', true);
    $index++;
}

$pdf->SetFont('helvetica', 'B', 16);
$pdf->Cell(190, 10, 'Note: You have to summit this to your register Faculty.', 0, 1, 'C');
$pdf->Output('Feedback_Report_' . str_replace(' ', '_', $student_name) . '.pdf', 'D');

$stmt_feedback->close();
$conn->close();
?>
