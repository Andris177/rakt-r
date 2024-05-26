<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "raktar";

// Kapcsolódás az adatbázishoz
$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolódás ellenőrzése
if ($conn->connect_error) {
    die ("Connection failed: " . $conn->connect_error);
}

// Ellenőrizzük, hogy a kérés GET metódussal érkezett-e és van-e id paraméter
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset ($_GET['id'])) {
    // Az id paraméter értékének meghatározása
    $id = $_GET['id'];

    // SQL parancs a termék törlésére az id alapján
    $sql = "DELETE FROM products WHERE id='$id'";

    // A törlés végrehajtása és ellenőrzése
    if ($conn->query($sql) === TRUE) {
        echo "Termék sikeresen törölve!";
    } else {
        echo "Hiba: " . $sql . "<br>" . $conn->error;
    }
}

// Kapcsolat bezárása
$conn->close();