<?php
// Adatbázis kapcsolat létrehozása
$servername = "localhost"; // Az adatbázis szerver neve vagy IP címe
$username = "root"; // Az adatbázis felhasználóneve
$password = ""; // Az adatbázis jelszava
$dbname = "raktar"; // Az adatbázis neve

// Adatbázis kapcsolat létrehozása és ellenőrzése
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die ("Sikertelen kapcsolódás az adatbázishoz: " . $conn->connect_error);
}

// Ellenőrizzük, hogy a POST kérést küldtek-e
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Termék adatainak beolvasása a POST kérésből
    $name = $_POST["name"];
    $price = $_POST["price"];
    $quantity = $_POST["quantity"];
    $min_quantity = $_POST["min_quantity"];
    $id_store = $_POST["id_store"];
    $id_row = $_POST["id_row"];
    $id_column = $_POST["id_column"];
    $id_shelf = $_POST["id_shelf"];

    // Új termék hozzáadása az adatbázishoz
    $sql = "INSERT INTO products (name, price, quantity, min_quantity, id_store, id_row, id_column, id_shelf)
    VALUES ('$name', '$price', '$quantity', '$min_quantity', '$id_store', '$id_row', '$id_column', '$id_shelf')";

    if ($conn->query($sql) === TRUE) {
        echo "Az új termék sikeresen hozzá lett adva.";
    } else {
        echo "Hiba történt a termék hozzáadása közben: " . $conn->error;
    }
}

// Adatbázis kapcsolat bezárása
$conn->close();
?>