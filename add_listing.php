<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'owner') {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = htmlspecialchars($_POST['title']);
    $desc = htmlspecialchars($_POST['description']);
    $location = htmlspecialchars($_POST['location']);
    $price = $_POST['price'];
    $owner_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO listings (title, description, location, price, owner_id) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssii", $title, $desc, $location, $price, $owner_id);

    if ($stmt->execute()) {
        echo "Listing added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>