<?php
require 'db.php';
session_start();
if (!isset($_SESSION['driver_id'])) {
    echo '<script>window.location.href = "login.php";</script>';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $request_id = $_POST['request_id'];
    $type = $_POST['type'];
    $driver_id = $_SESSION['driver_id'];

    if ($type == 'ride') {
        $stmt = $pdo->prepare("UPDATE rides SET driver_id = ?, status = 'accepted' WHERE id = ?");
        $stmt->execute([$driver_id, $request_id]);
    } else {
        $stmt = $pdo->prepare("UPDATE deliveries SET driver_id = ?, status = 'accepted' WHERE id = ?");
        $stmt->execute([$driver_id, $request_id]);
    }
    $stmt = $pdo->prepare("UPDATE drivers SET status = 'busy' WHERE id = ?");
    $stmt->execute([$driver_id]);
    echo '<script>window.location.href = "track.php?type=' . $type . '";</script>';
}

$rides = $pdo->query("SELECT * FROM rides WHERE status = 'pending'")->fetchAll();
$deliveries = $pdo->query("SELECT * FROM deliveries WHERE status = 'pending'")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driver Dashboard</title>
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
        .requests {
            padding: 40px;
        }
        .request-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .request-card h3 {
            color: #00aaff;
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
        @media (max-width: 768px) {
            .requests {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Driver Dashboard</h1>
        <button class="btn" onclick="window.location.href='logout.php'">Logout</button>
    </div>
    <div class="requests">
        <h2>Pending Requests</h2>
        <?php foreach ($rides as $ride): ?>
            <div class="request-card">
                <h3>Ride Request</h3>
                <p>From: <?php echo $ride['pickup_location']; ?></p>
                <p>To: <?php echo $ride['dropoff_location']; ?></p>
                <p>Fare: $<?php echo $ride['fare']; ?></p>
                <form method="POST">
                    <input type="hidden" name="request_id" value="<?php echo $ride['id']; ?>">
                    <input type="hidden" name="type" value="ride">
                    <button type="submit" class="btn">Accept</button>
                </form>
            </div>
        <?php endforeach; ?>
        <?php foreach ($deliveries as $delivery): ?>
            <div class="request-card">
                <h3>Delivery Request</h3>
                <p>From: <?php echo $delivery['pickup_location']; ?></p>
                <p>To: <?php echo $delivery['dropoff_location']; ?></p>
                <p>Details: <?php echo $delivery['package_details']; ?></p>
                <p>Fare: $<?php echo $delivery['fare']; ?></p>
                <form method="POST">
                    <input type="hidden" name="request_id" value="<?php echo $delivery['id']; ?>">
                    <input type="hidden" name="type" value="delivery">
                    <button type="submit" class="btn">Accept</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
