<?php
include 'db.php';

$sql = "SELECT * FROM rooms ORDER BY price ASC";
$result = $conn->query($sql);

$rooms = array();
while ($row = $result->fetch_assoc()) {
    $rooms[] = $row;
}

echo json_encode($rooms);
?>
