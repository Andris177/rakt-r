<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "raktar";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "CREATE TABLE IF NOT EXISTS Users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    is_active TINYINT DEFAULT 0,
    name VARCHAR(50) NOT NULL,
    email VARCHAR(25) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    token VARCHAR(100),
    token_valid_until DATETIME,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    registered_at DATETIME,
    picture VARCHAR(50),
    deleted_at DATETIME
)";

if ($conn->query($sql) === TRUE) {
    echo "Table Users created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
