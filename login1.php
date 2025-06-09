<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <title>Login Page</title>
    <link rel="stylesheet" href="style1.css">
</head>
<body>
    <div class="container">
        <h1>Login Page</h1>
        
        <!-- Student Login Button -->
        <form action="login.php" method="GET">
            <input type="hidden" name="role" value="student">
            <button type="submit">Student Login</button>
        </form>

        <!-- Admin Login Button -->
        <form action="admin_login.php" method="GET">
            <input type="hidden" name="role" value="admin">
            <button type="submit">Admin Login</button>
        </form>

        <p>Don't have an account? <a href="reg1.php">Register here</a></p>
    </div>
</body>
</html>