<?php
include 'db.php';

$success_message = ""; 
$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $branch = $_POST['branch'];
    $email = !empty($_POST['email']) ? $_POST['email'] : NULL; // Allow NULL email

    if ($email) {
        // Check if the email already exists
        $check_email_sql = "SELECT * FROM faculty WHERE email=?";
        $stmt = $conn->prepare($check_email_sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $check_email_result = $stmt->get_result();

        if ($check_email_result->num_rows > 0) {
            $error_message = "Error: The email '$email' is already in use.";
        } else {
            // Insert faculty into the database
            $sql = "INSERT INTO faculty (name, branch, email) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $name, $branch, $email);
            
            if ($stmt->execute()) {
                $success_message = "Faculty added successfully!";
            } else {
                $error_message = "Error: " . $stmt->error;
            }
        }
    } else {
        // Insert faculty into the database without email
        $sql = "INSERT INTO faculty (name, branch) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $name, $branch);
        
        if ($stmt->execute()) {
            $success_message = "Faculty added successfully!";
        } else {
            $error_message = "Error: " . $stmt->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link rel="stylesheet" href="style1.css"> 
    <title>Add Faculty</title>
</head>
<body>
    <div class="container">
        <form method="POST">
            <h2>Add Faculty</h2>
            <input type="text" name="name" placeholder="Faculty Name" required>
            <input type="email" name="email" placeholder="Faculty Email (optional)"> <!-- Optional email input -->
            <select name="branch" required>
                <option value="">Select Branch</option>
                <option value="Computer">Computer</option>
                <option value="Information Technology">Information Technology</option>
                <option value="Mechanical">Mechanical</option>
                <option value="Civil">Civil</option>
                <option value="Chemical">Chemical</option>
                <option value="Electrical">Electrical</option>
            </select>
            <button type="submit">Add Faculty</button>
            <button type="button" class="logout-button" onclick="window.location.href='logout.php'">Logout</button>
        </form>

        <?php if (!empty($success_message)): ?>
            <div class="success"><?php echo $success_message; ?></div>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <div class="error"><?php echo $error_message; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>