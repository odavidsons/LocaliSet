<?php
require_once '../config.php';

// Connect to the database
$connection = new mysqli($_dbhost, $_dbusername, $_dbpassword, $_dbname);
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //Ações escritorios
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

    //Ações incubadora
     if (isset($_POST['add_incubadora'])) {
        $nome = $_POST['NomeIncubadora'];
        $latitude = $_POST['LatitudeIncubadora'];
        $longitude = $_POST['LongitudeIncubadora'];
        $contacto = $_POST['ContactoIncubadora'];
        $email = $_POST['EmailIncubadora'];
        $numEscritorios = $_POST['QtdEscritoriosIncubadora'];

        $stmt = $connection->prepare("INSERT INTO incubadora (Nome, Latitude, Longitude, Contacto, Email, NumEscritorios) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sddssi", $nome, $latitude, $longitude, $contacto, $email, $numEscritorios);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['update_incubadora'])) {
        $id_incubadora = $_POST['ID_Incubadora'];
        $nome = $_POST['NomeIncubadora'];
        $latitude = $_POST['LatitudeIncubadora'];
        $longitude = $_POST['LongitudeIncubadora'];
        $contacto = $_POST['ContactoIncubadora'];
        $email = $_POST['EmailIncubadora'];
        $numEscritorios = $_POST['QtdEscritoriosIncubadora'];
        
        $stmt = $connection->prepare("UPDATE incubadora SET Nome = ?, Latitude = ?, Longitude = ?, Contacto = ?, Email = ?, NumEscritorios = ? WHERE ID = ?");
        $stmt->bind_param("sddssii", $nome, $latitude, $longitude, $contacto, $email, $numEscritorios, $id_incubadora);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['delete_incubadora'])) {
        $id_incubadora = $_POST['ID_Incubadora'];
        
        $stmt = $connection->prepare("DELETE FROM incubadora WHERE ID = ?");
        $stmt->bind_param("i", $id_incubadora);
        $stmt->execute();
        $stmt->close();
    }
}

// Redirect back to the main admin page
header("Location: ../index.php?page=adminPanel");
exit();
?>
