<?php
$servername = "localhost";
$username = "root";
$password = ""; // Általában a jelszó üres marad alapértelmezés szerint
$dbname = "raktar";

// Adatbázis kapcsolódás létrehozása
$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolat ellenőrzése
if ($conn->connect_error) {
    die ("Connection failed: " . $conn->connect_error);
}

// HTTP GET kérés kezelése
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Ellenőrizze, hogy az id paraméter meg van adva
    if (isset ($_GET['id']) && !empty ($_GET['id'])) {
        $id = $_GET['id'];

        // SQL lekérdezés a termék lekérdezésére az id alapján
        $sql = "SELECT * FROM products WHERE id = $id";
        $result = $conn->query($sql);

        // Ellenőrizze, hogy található-e eredmény a lekérdezésben
        if ($result->num_rows > 0) {
            // Visszaadja a termék adatait JSON formátumban
            $row = $result->fetch_assoc();
            echo json_encode($row);
        } else {
            // Ha nincs eredmény, akkor üres választ ad
            echo "{}";
        }
    } else {
        // Ha nincs id paraméter, akkor hibaüzenetet ad
        echo "Hiba: Hiányzó vagy érvénytelen id paraméter.";
    }
}

// Adatbázis kapcsolat lezárása
$conn->close();