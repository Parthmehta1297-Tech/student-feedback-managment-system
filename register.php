<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle student registration
    if (isset($_POST['student_register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $branch = $_POST['branch'];

        $sql = "INSERT INTO students (name, email, password, branch) VALUES ('$name', '$email', '$password', '$branch')";
        if ($conn->query($sql) === TRUE) {
            $success = "Registration successful! You can now log in.";
        } else {
            $error = "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register</title>
    <style>body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    font-family: 'Roboto', sans-serif;
    background-image: linear-gradient(to right, #FFEFBA, #FFFFFF);
    }
    .container {
    max-width: 400px;
    width: 90%;
    padding: 25px;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
    text-align: center;
    }
    h2 {
    color: #4A90E2;
    font-size: 2em;
    font-weight: bold;
    margin-bottom: 20px;
    }
    .error {
    color: #e74c3c;
    margin-bottom: 15px;
    }
    input[type="email"],
    input[type="password"] {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1em;
    }
    button {
    background-image: linear-gradient(to right, #FFB6C1, #FF69B4);
    padding: 12px 20px;
    text-align: center;
    text-transform: uppercase;
    transition: 0.4s;
    background-size: 200% auto;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1em;
    cursor: pointer;
    font-weight: bold;
    }
    button:hover {
    background-position: right center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    a {
    color: #4A90E2;
    text-decoration: none;
    }
    a:hover {
    text-decoration: underline;
    }
    p {
    margin-top: 10px;
    font-size: 0.9em;
    }
    </style>
</head>
<body>
    <div class="container">
        <form method="POST">
            <h2>Student Registration</h2>
            <?php if (isset($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <?php if (isset($success)): ?>
                <div class="success"><?php echo $success; ?></div>
            <?php endif; ?>
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="branch" required>
                <option value="">Select Branch</option>
                <option value="Computer">Computer</option>
                <option value="Information Technology">Information Technology</option>
                <option value="Mechanical">Mechanical</option>
                <option value="Civil">Civil</option>
                <option value="Chemical">Chemical</option>
                <option value="Electrical">Electrical</option>
            </select>
            <button type="submit" name="student_register">Register</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a></p>
        <p>Admin? <a href="admin_register.php">Register here</a></p>
    </div>
 </body>
</html>