<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $type = $_POST['type'];

    if ($type == 'user') {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            echo '<script>window.location.href = "dashboard.php";</script>';
        } else {
            echo '<script>alert("Invalid credentials");</script>';
        }
    } else {
        $stmt = $pdo->prepare("SELECT * FROM drivers WHERE email = ?");
        $stmt->execute([$email]);
        $driver = $stmt->fetch();
        if ($driver && password_verify($password, $driver['password'])) {
            $_SESSION['driver_id'] = $driver['id'];
            echo '<script>window.location.href = "driver_dashboard.php";</script>';
        } else {
            echo '<script>alert("Invalid credentials");</script>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .login-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 400px;
            text-align: center;
        }
        .login-container h2 {
            color: #00aaff;
        }
        .login-container input, .login-container select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            background-color: #00aaff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .btn:hover {
            background-color: #0088cc;
        }
        .link {
            color: #00aaff;
            text-decoration: none;
        }
        @media (max-width: 480px) {
            .login-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="type">
                <option value="user">User</option>
                <option value="driver">Driver</option>
            </select>
            <button type="submit" class="btn">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php" class="link">Sign Up</a></p>
    </div>
</body>
</html>
