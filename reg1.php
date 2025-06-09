<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #FFEFBA, #FFFFFF, #A1C4FD);
            animation: gradientBG 10s ease infinite;
            background-size: 200% 200%;
        }
        
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .container {
            max-width: 400px;
            width: 90%;
            padding: 30px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .container:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25);
        }
        
        h2 {
            color: #4A90E2;
            font-size: 2em;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.1);
        }
        
        button {
            background: linear-gradient(to right, #FFB6C1, #FF69B4);
            padding: 12px 20px;
            text-align: center;
            text-transform: uppercase;
            transition: all 0.4s ease;
            background-size: 200% auto;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            cursor: pointer;
            font-weight: bold;
            margin: 10px 0;
            width: 100%;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }
        
        button:hover {
            background-position: right center;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome</h2>
        <button onclick="location.href='register.php'">Register as Student</button>
        <button onclick="location.href='admin_register.php'">Register as Admin</button>
    </div>
</body>
</html>