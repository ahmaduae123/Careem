<?php
session_start();
if (!isset($_SESSION['user_id']) && !isset($_SESSION['driver_id'])) {
    echo '<script>window.location.href = "login.php";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Ride/Delivery</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
            margin: 0;
            padding: 20px;
        }
        .tracking-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            text-align: center;
            max-width: 600px;
            margin: auto;
        }
        .tracking-container h2 {
            color: #00aaff;
        }
        #map {
            width: 100%;
            height: 400px;
            background: #e0e0e0;
            border-radius: 10px;
            margin: 20px 0;
        }
        .btn {
            background-color: #00aaff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #0088cc;
        }
        @media (max-width: 480px) {
            .tracking-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="tracking-container">
        <h2>Track Your <?php echo $_GET['type'] == 'ride' ? 'Ride' : 'Delivery'; ?></h2>
        <div id="map">Map Placeholder (Simulated)</div>
        <p id="status">Driver is on the way...</p>
        <button class="btn" onclick="window.location.href='dashboard.php'">Back to Dashboard</button>
    </div>
    <script>
        // Simulated tracking
        const status = document.getElementById('status');
        const statuses = ['Driver is on the way...', 'Driver is 5 minutes away...', 'Driver has arrived!'];
        let index = 0;
        setInterval(() => {
            status.textContent = statuses[index];
            index = (index + 1) % statuses.length;
        }, 5000);
    </script>
</body>
</html>
