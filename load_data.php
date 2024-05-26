<?php
// Adatbázis kapcsolódás
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "raktar";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die ("Sikertelen kapcsolódás: " . $conn->connect_error);
}

// Betöltés az üzletek táblába
$sql = "LOAD DATA INFILE 'raktar.csv' INTO TABLE stores FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\n' IGNORE 1 LINES";
if ($conn->query($sql) === TRUE) {
    echo "Üzletek betöltve<br>";
} else {
    echo "Hiba az üzletek betöltésekor: " . $conn->error . "<br>";
}

// Betöltés a sorok táblába
$sql = "LOAD DATA INFILE 'raktar.csv' INTO TABLE rows_data FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\n' IGNORE 1 LINES";
if ($conn->query($sql) === TRUE) {
    echo "Sorok betöltve<br>";
} else {
    echo "Hiba a sorok betöltésekor: " . $conn->error . "<br>";
}

// Betöltés az oszlopok táblába
$sql = "LOAD DATA INFILE 'raktar.csv' INTO TABLE columns FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\n' IGNORE 1 LINES";
if ($conn->query($sql) === TRUE) {
    echo "Oszlopok betöltve<br>";
} else {
    echo "Hiba az oszlopok betöltésekor: " . $conn->error . "<br>";
}

// Betöltés a polcok táblába
$sql = "LOAD DATA INFILE 'raktar.csv' INTO TABLE shelves FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\n' IGNORE 1 LINES";
if ($conn->query($sql) === TRUE) {
    echo "Polcok betöltve<br>";
} else {
    echo "Hiba a polcok betöltésekor: " . $conn->error . "<br>";
}

// Betöltés a termékek táblába
$sql = "LOAD DATA INFILE 'raktar.csv' INTO TABLE products FIELDS TERMINATED BY ',' ENCLOSED BY '\"' LINES TERMINATED BY '\n' IGNORE 1 LINES";
if ($conn->query($sql) === TRUE) {
    echo "Termékek betöltve<br>";
} else {
    echo "Hiba a termékek betöltésekor: " . $conn->error . "<br>";
}

// Adatbázis kapcsolat bezárása
$conn->close();
