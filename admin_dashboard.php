<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

// Fetch all users
$users = $conn->query("SELECT id, username, email, role FROM users");

// Fetch all listings
$listings = $conn->query("SELECT * FROM listings");

// Fetch issues (optional)
$issues = $conn->query("SELECT * FROM issues");

?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="form-card">
    <h2>Admin Dashboard</h2>

    <h3>Users</h3>
    <ul>
    <?php while($u = $users->fetch_assoc()): ?>
        <li><?= $u['username'] ?> (<?= $u['role'] ?>) - <?= $u['email'] ?></li>
    <?php endwhile; ?>
    </ul>

    <h3>Listings</h3>
    <ul>
    <?php while($l = $listings->fetch_assoc()): ?>
        <li><?= $l['title'] ?> - <?= $l['location'] ?> - Rs.<?= $l['price'] ?></li>
    <?php endwhile; ?>
    </ul>
</div>
</body>
</html>