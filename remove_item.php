<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db   = "manga_store";

$conn = new mysqli($host, $user, $pass, $db);

$cart_id = $_POST['cart_id'];

$sql = "DELETE FROM cart WHERE cart_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $cart_id);

if ($stmt->execute()) {
    echo "Item removed";
} else {
    echo "Error removing item";
}
