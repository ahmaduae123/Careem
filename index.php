<?php
session_start();
if (isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "dashboard.php";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Careem Clone - Home</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        }
        .header {
            background-color: #00aaff;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 2.5em;
        }
        .services {
            display: flex;
            justify-content: space-around;
            padding: 40px;
        }
        .service-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 30%;
            text-align: center;
            padding: 20px;
            transition: transform 0.3s;
        }
        .service-card:hover {
            transform: scale(1.05);
        }
        .service-card img {
            width: 100%;
            border-radius: 10px;
        }
        .service-card h3 {
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
            margin-top: 10px;
        }
        .btn:hover {
            background-color: #0088cc;
        }
        @media (max-width: 768px) {
            .services {
                flex-direction: column;
                align-items: center;
            }
            .service-card {
                width: 80%;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome to Ride & Deliver</h1>
        <p>Your one-stop solution for rides and deliveries</p>
    </div>
    <div class="services">
        <div class="service-card">
            <img src="https://via.placeholder.com/300x200?text=Ride" alt="Ride">
            <h3>Ride-Hailing</h3>
            <p>Book a car or bike for quick and comfortable travel.</p>
            <button class="btn" onclick="window.location.href='signup.php'">Get Started</button>
        </div>
        <div class="service-card">
            <img src="https://via.placeholder.com/300x200?text=Bike" alt="Bike">
            <h3>Bike Rides</h3>
            <p>Fast and affordable bike rides for short trips.</p>
            <button class="btn" onclick="window.location.href='signup.php'">Get Started</button>
        </div>
        <div class="service-card">
            <img src="https://via.placeholder.com/300x200?text=Delivery" alt="Delivery">
            <h3>Parcel Delivery</h3>
            <p>Send packages with ease and track them in real-time.</p>
            <button class="btn" onclick="window.location.href='signup.php'">Get Started</button>
        </div>
    </div>
</body>
</html>
