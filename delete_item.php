<?php
include 'db.php';

$item_id = $_GET['id'];

$stmt = $conn->prepare("DELETE FROM items WHERE item_id = ?");
$stmt->bind_param("i", $item_id);
$stmt->execute();
$stmt->close();

header("Location: index.php");
?>
