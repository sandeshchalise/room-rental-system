<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET username=?, email=?, password=? WHERE id=?");
    $stmt->bind_param("sssi", $username, $email, $password, $id);

    if ($stmt->execute()) {
        echo "Profile updated.";
    } else {
        echo "Update failed.";
    }
}
?>