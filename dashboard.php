<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "login.php";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            margin: 0;
        }
        .header {
            background-color: #00aaff;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .options {
            display: flex;
            justify-content: space-around;
            padding: 40px;
        }
        .option-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 30%;
            text-align: center;
            padding: 20px;
            transition: transform 0.3s;
        }
        .option-card:hover {
            transform: scale(1.05);
        }
        .option-card h3 {
            color: #00aaff;
        }
        .btn {
            background-color: #00aaff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn:hover {
            background-color: #0088cc;
        }
        @media (max-width: 768px) {
            .options {
                flex-direction: column;
                align-items: center;
            }
            .option-card {
                width: 80%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>User Dashboard</h1>
        <button class="btn" onclick="window.location.href='logout.php'">Logout</button>
    </div>
    <div class="options">
        <div class="option-card">
            <h3>Book a Ride</h3>
            <p>Travel comfortably with our ride-hailing service.</p>
            <button class="btn" onclick="window.location.href='book_ride.php'">Book Now</button>
        </div>
        <div class="option-card">
            <h3>Send a Parcel</h3>
            <p>Deliver packages quickly and securely.</p>
            <button class="btn" onclick="window.location.href='book_delivery.php'">Send Now</button>
        </div>
        <div class="option-card">
            <h3>Manage Wallet</h3>
            <p>Recharge and pay with your digital wallet.</p>
            <button class="btn" onclick="window.location.href='wallet.php'">Go to Wallet</button>
        </div>
    </div>
</body>
</html>
