<?php

include('database.php');


// $conn->query("DROP TABLE orders");

// Ensure users table exists (you already have it)
$conn->query("CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB");

// Ensure products table exists
$conn->query("CREATE TABLE IF NOT EXISTS products (
    product_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    genre VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) DEFAULT 0.00
) ENGINE=InnoDB");

// Create orders table
$sql_orders = "CREATE TABLE IF NOT EXISTS orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB";

if($conn->query($sql_orders) === TRUE){
    echo "Table 'orders' created successfully.<br>";
} else {
    echo "Error creating 'orders' table: " . $conn->error . "<br>";
}

// Create order_items table
$sql_order_items = "CREATE TABLE IF NOT EXISTS order_items (
    order_item_id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL DEFAULT 1,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB";

if($conn->query($sql_order_items) === TRUE){
    echo "Table 'order_items' created successfully.<br>";
} else {
    echo "Error creating 'order_items' table: " . $conn->error . "<br>";
}

$conn->close();
echo "<br>Orders tables setup completed!";
?>
