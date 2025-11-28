<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "manga_store";

// Connect to MySQL
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

// Array of manga products
$products = [
    [
        "title" => "One Piece",
        "genre" => "Adventure / Fantasy",
        "image" => "src/images/one_piece.jpg",
        "price" => 5.99
    ],
    [
        "title" => "Naruto",
        "genre" => "Adventure / Ninja / Shonen",
        "image" => "src/images/naruto.jpg",
        "price" => 4.99
    ],
    [
        "title" => "Bleach",
        "genre" => "Supernatural / Action / Shonen",
        "image" => "src/images/bleach.jpg",
        "price" => 4.50
    ],
    [
        "title" => "Monster",
        "genre" => "Thriller / Mystery",
        "image" => "src/images/monster.jpg",
        "price" => 6.00
    ],
    [
        "title" => "Attack on Titan",
        "genre" => "Action / Dark Fantasy / Drama",
        "image" => "src/images/aot_manga_cover.jpg",
        "price" => 5.50
    ],
    [
        "title" => "Demon Slayer",
        "genre" => "Dark Fantasy / Action",
        "image" => "src/images/demon_slayer.jpeg",
        "price" => 5.25
    ],
    [
        "title" => "Digimon",
        "genre" => "Adventure / Fantasy / Action",
        "image" => "src/images/digimon.webp",
        "price" => 4.75
    ],
    [
        "title" => "Gintama",
        "genre" => "Comedy / Action / Sci-Fi",
        "image" => "src/images/gintama.webp",
        "price" => 4.99
    ]
];

// Insert each product
$stmt = $conn->prepare("INSERT INTO products (title, genre, image, price) VALUES (?, ?, ?, ?)");
$stmt->bind_param("sssd", $title, $genre, $image, $price);

foreach($products as $p) {
    $title = $p["title"];
    $genre = $p["genre"];
    $image = $p["image"];
    $price = $p["price"];
    $stmt->execute();
}

echo "All manga products inserted successfully!";
$stmt->close();
$conn->close();
?>
