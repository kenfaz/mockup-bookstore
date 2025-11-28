<?php
// Database credentials
$servername = "localhost";  // Usually localhost
$username = "root";         // MySQL username
$password = "";             // MySQL password (blank in XAMPP default)
$dbname = "manga_store";    // Name of your database

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// echo "Connected successfully";
?>