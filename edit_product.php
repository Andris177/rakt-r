<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "raktar";

// Kapcsolódás az adatbázishoz
$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolat ellenőrzése
if ($conn->connect_error) {
    die ("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET['id']; // A módosítandó termék azonosítója
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $min_quantity = $_POST['min_quantity'];
    $id_store = $_POST['id_store'];
    $id_row = $_POST['id_row'];
    $id_column = $_POST['id_column'];
    $id_shelf = $_POST['id_shelf'];

    // SQL parancs a termék adatainak frissítésére
    $sql = "UPDATE products SET name='$name', price='$price', quantity='$quantity', min_quantity='$min_quantity', id_store='$id_store', id_row='$id_row', id_column='$id_column', id_shelf='$id_shelf' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Termék adat sikeresen módosítva!";
    } else {
        echo "Hiba: " . $sql . "<br>" . $conn->error;
    }
}

// Kapcsolat bezárása
$conn->close();
?>