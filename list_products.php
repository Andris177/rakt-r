<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "raktar";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Termékek listája</h2><ul>";
    while ($row = $result->fetch_assoc()) {
        echo "<button onclick='editProduct(" . $row["id"] . ")'>Módosítás</button> <button onclick='deleteProduct(" . $row["id"] . ")'>Törlés</button>";
        echo "<li><strong>Név:</strong> " . $row["name"] . " <strong>Ár:</strong> " . $row["price"] . " <strong>Mennyiség:</strong> " . $row["quantity"] . " <strong>Minimum mennyiség:</strong> " . $row["min_quantity"] . " <strong>Raktár azonosító:</strong> " . $row["id_store"] . " <strong>Sor:</strong> " . $row["id_row"] . " <strong>Oszlop:</strong> " . $row["id_column"] . " <strong>Polc:</strong> " . $row["id_shelf"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "Nincsenek termékek.";
}
$conn->close();
