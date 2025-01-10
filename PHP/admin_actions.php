<?php
require_once '../config.php';

// Connect to the database
$connection = new mysqli($_dbhost, $_dbusername, $_dbpassword, $_dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['add'])) {
        $idIncubadora = $_POST['IDIncubadora'];
        $tamanho = $_POST['Tamanho'];
        $preco = $_POST['Preco'];
        $disponibilidade = $_POST['Disponibilidade'];
        $numero = $_POST['Numero'];

        $stmt = $connection->prepare("INSERT INTO escritorio (IDIncubadora, Tamanho, Preco, Disponibilidade, Numero) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("isdsi", $idIncubadora, $tamanho, $preco, $disponibilidade, $numero);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['update'])) {
        $id = $_POST['ID'];
        $idIncubadora = $_POST['IDIncubadora'];
        $tamanho = $_POST['Tamanho'];
        $preco = $_POST['Preco'];
        $disponibilidade = $_POST['Disponibilidade'];
        $numero = $_POST['Numero'];

        $stmt = $connection->prepare("UPDATE escritorio SET IDIncubadora = ?, Tamanho = ?, Preco = ?, Disponibilidade = ?, Numero = ? WHERE ID = ?");
        $stmt->bind_param("isdssi", $idIncubadora, $tamanho, $preco, $disponibilidade, $numero, $id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['delete'])) {
        $id = $_POST['ID'];
        $stmt = $connection->prepare("DELETE FROM escritorio WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
    }
}

// Redirect back to the main admin page
header("Location: ../index.php?page=adminPanel");
exit();
?>
