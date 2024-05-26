<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "raktar";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $min_quantity = $_POST['min_quantity'];
    $id_store = $_POST['id_store'];
    $id_row = $_POST['id_row'];
    $id_column = $_POST['id_column'];
    $id_shelf = $_POST['id_shelf'];
    $id = $_POST['id'];

    $sql = "INSERT INTO products (id, name, price, quantity, min_quantity, id_store, id_row, id_column, id_shelf) 
            VALUES ('$id','$name', '$price', '$quantity', '$min_quantity', '$id_store', '$id_row', '$id_column', '$id_shelf')";

    if ($conn->query($sql) === TRUE) {
        echo "Termék sikeresen hozzáadva!";
    } else {
        echo "Hiba: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
