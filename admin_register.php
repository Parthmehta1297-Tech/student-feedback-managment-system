<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_username = $_POST['admin_username'];
    $admin_password = password_hash($_POST['admin_password'], PASSWORD_DEFAULT);
    $admin_email = $_POST['admin_email'];

    // Use prepared statements to avoid SQL injection
    $stmt = $conn->prepare("INSERT INTO admins (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $admin_username, $admin_password, $admin_email);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        $success_admin = "Admin registration successful! You can now log in.";
    } else {
        $error_admin = "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style1.css">
    <title>Admin Registration</title>
</head>
<body>
    <div class="container">
        <form method="POST">
            <h2>Admin Registration</h2>
            <?php if (isset($error_admin)): ?>
                <div class="error"><?php echo $error_admin; ?></div>
            <?php endif; ?>
            <?php if (isset($success_admin)): ?>
                <div class="success"><?php echo $success_admin; ?></div>
            <?php endif; ?>
            <input type="text" name="admin_username" placeholder="Username" required>
            <input type="password" name="admin_password" placeholder="Password" required>
            <input type="email" name="admin_email" placeholder="Email" required>
            <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="admin_login.php">Login here</a></p>
    </div>
</body>
</html>
                