<?php
session_start();
require 'config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'owner') {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST['id'];
    $title = htmlspecialchars($_POST['title']);
    $desc = htmlspecialchars($_POST['description']);
    $location = htmlspecialchars($_POST['location']);
    $price = $_POST['price'];

    $stmt = $conn->prepare("UPDATE listings SET title=?, description=?, location=?, price=? WHERE id=? AND owner_id=?");
    $stmt->bind_param("sssiii", $title, $desc, $location, $price, $id, $_SESSION['user_id']);

    if ($stmt->execute()) {
        echo "Listing updated.";
    } else {
        echo "Update failed.";
    }
}
?>