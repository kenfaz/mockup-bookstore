<?php
session_start();
$host = "localhost";
$user = "root";
$pass = "";
$db   = "manga_store";

if (!isset($_SESSION['user_id'])) {
    echo "You must log in first.";
    exit;
}

$user_id = $_SESSION['user_id'];

$conn = new mysqli($host, $user, $pass, $db);

// ----------------------------------------
// 1. Get items from cart
// ----------------------------------------
$cartQuery = $conn->query("
    SELECT cart.product_id, cart.quantity, products.price
    FROM cart
    JOIN products ON cart.product_id = products.id
    WHERE cart.user_id = $user_id
");

if ($cartQuery->num_rows === 0) {
    echo "Cart is empty.";
    exit;
}

// ----------------------------------------
// 2. Create order record
// ----------------------------------------
$conn->query("
    INSERT INTO orders (user_id, order_date)
    VALUES ($user_id, NOW())
");

$order_id = $conn->insert_id;

// ----------------------------------------
// 3. Insert items into order_items
// ----------------------------------------
while ($item = $cartQuery->fetch_assoc()) {
    $pid = $item['product_id'];
    $qty = $item['quantity'];
    $price = $item['price'];

    $conn->query("
        INSERT INTO order_items (order_id, product_id, quantity, price)
        VALUES ($order_id, $pid, $qty, $price)
    ");
}

// ----------------------------------------
// 4. Clear cart after checkout
// ----------------------------------------
$conn->query("DELETE FROM cart WHERE user_id = $user_id");

echo "Checkout success!";
?>
