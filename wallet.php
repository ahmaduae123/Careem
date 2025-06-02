<?php
require 'db.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    echo '<script>window.location.href = "login.php";</script>';
}

$user_id = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT balance FROM wallet WHERE user_id = ?");
$stmt->execute([$user_id]);
$wallet = $stmt->fetch();
if (!$wallet) {
    $stmt = $pdo->prepare("INSERT INTO wallet (user_id, balance) VALUES (?, 0)");
    $stmt->execute([$user_id]);
    $wallet = ['balance' => 0];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $amount = $_POST['amount'];
    $stmt = $pdo->prepare("UPDATE wallet SET balance = balance + ? WHERE user_id = ?");
    $stmt->execute([$amount, $user_id]);
    $stmt = $pdo->prepare("INSERT INTO notifications (user_id, message, type) VALUES (?, ?, 'wallet')");
    $stmt->execute([$user_id, "Wallet recharged with $$amount"]);
    echo '<script>window.location.href = "wallet.php";</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wallet</title>
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
        .wallet-container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 400px;
            text-align: center;
        }
        .wallet-container h2 {
            color: #00aaff;
        }
        .wallet-container input {
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
            .wallet-container {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <div class="wallet-container">
        <h2>Wallet</h2>
        <p>Current Balance: $<?php echo $wallet['balance']; ?></p>
        <form method="POST">
            <input type="number" name="amount" placeholder="Recharge Amount" required>
            <button type="submit" class="btn">Recharge</button>
        </form>
        <button class="btn" onclick="window.location.href='dashboard.php'">Back to Dashboard</button>
    </div>
</body>
</html>
