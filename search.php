<?php
require 'config/db.php';

$location = isset($_GET['location']) ? $_GET['location'] : '';
$maxPrice = isset($_GET['maxPrice']) ? (int)$_GET['maxPrice'] : 0;

$sql = "SELECT * FROM listings WHERE 1";
$params = [];
$types = '';

if ($location !== '') {
    $sql .= " AND location LIKE ?";
    $params[] = "%$location%";
    $types .= 's';
}
if ($maxPrice > 0) {
    $sql .= " AND price <= ?";
    $params[] = $maxPrice;
    $types .= 'i';
}

$stmt = $conn->prepare($sql);
if ($params) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
$listings = $result->fetch_all(MYSQLI_ASSOC);

echo json_encode($listings);
?>