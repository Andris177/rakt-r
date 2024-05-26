<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "raktar";

// Kapcsolat létrehozása
$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolat ellenőrzése
if ($conn->connect_error) {
    die("Kapcsolati hiba: " . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT id, password, is_active FROM Users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($id, $hashed_password, $is_active);
$stmt->fetch();

if ($stmt->num_rows > 0) {
    if (password_verify($password, $hashed_password)) {
        if ($is_active) {
            echo "Sikeres bejelentkezés!";
        } else {
            echo "Fiók nem aktivált.";
        }
    } else {
        echo "Hibás jelszó.";
    }
} else {
    echo "Nincs ilyen felhasználó.";
}

$stmt->close();
$conn->close();
?>
