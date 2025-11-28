<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db   = "manga_store";

$conn = new mysqli($host, $user, $pass, $db);

$cart_id = $_POST['cart_id'];
$change  = $_POST['change'];

$sql = "UPDATE cart SET quantity = GREATEST(1, quantity + ?) WHERE cart_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $change, $cart_id);
$stmt->execute();

echo "Quantity updated";
