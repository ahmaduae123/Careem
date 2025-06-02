<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "login.php";</script>';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pickup = $_POST['pickup'];
    $dropoff = $_POST['dropoff'];
    $distance = rand(5, 50); // Simulated distance in km
    $fare = $distance * 2; // $2 per km
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO rides (user_id, pickup_location, dropoff_location, fare) VALUES (?, ?, ?, ?)");
    $stmt->execute([$user_id, $pickup, $dropoff, $fare]);

    $stmt = $pdo->prepare("INSERT INTO notifications (user_id, message, type) VALUES (?, ?, 'ride')");
    $stmt->execute([$user_id, "Ride booked from $pickup to $dropoff for $$fare"]);
    echo '<script>window.location.href = "track.php?type=ride";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a Ride</title>
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
        .booking-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 400px;
            text-align: center;
        }
        .booking-container h2 {
            color: #00aaff;
        }
        .booking-container input {
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
        @media (max-width: 480px) {
            .booking-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="booking-container">
        <h2>Book a Ride</h2>
        <form method="POST">
            <input type="text" name="pickup" placeholder="Pickup Location" required>
            <input type="text" name="dropoff" placeholder="Drop-off Location" required>
            <button type="submit" class="btn">Book Ride</button>
        </form>
    </div>
</body>
</html>
