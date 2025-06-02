<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $phone = $_POST['phone'];
    $type = $_POST['type'];
    $vehicle_type = $_POST['vehicle_type'] ?? null;

    if ($type == 'user') {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, phone) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $password, $phone]);
        $_SESSION['user_id'] = $pdo->lastInsertId();
        echo '<script>window.location.href = "dashboard.php";</script>';
    } else {
        $stmt = $pdo->prepare("INSERT INTO drivers (name, email, password, phone, vehicle_type) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $email, $password, $phone, $vehicle_type]);
        $_SESSION['driver_id'] = $pdo->lastInsertId();
        echo '<script>window.location.href = "driver_dashboard.php";</script>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
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
        .signup-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 400px;
            text-align: center;
        }
        .signup-container h2 {
            color: #00aaff;
        }
        .signup-container input, .signup-container select {
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
            .signup-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h2>Sign Up</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Name" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="text" name="phone" placeholder="Phone" required>
            <select name="type" id="type" onchange="toggleVehicle()">
                <option value="user">User</option>
                <option value="driver">Driver</option>
            </select>
            <select name="vehicle_type" id="vehicle_type" style="display: none;">
                <option value="car">Car</option>
                <option value="bike">Bike</option>
            </select>
            <button type="submit" class="btn">Sign Up</button>
        </form>
        <p>Already have an account? <a href="login.php" class="link">Login</a></p>
    </div>
    <script>
        function toggleVehicle() {
            const type = document.getElementById('type').value;
            document.getElementById('vehicle_type').style.display = type === 'driver' ? 'block' : 'none';
        }
    </script>
</body>
</html>
