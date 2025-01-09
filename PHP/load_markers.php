<?php
header('Content-Type: application/json');

require_once '../config.php';

try {
    $pdo = new PDO("mysql:host=$_dbhost;dbname=$_dbname", $_dbusername, $_dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query('SELECT ID, Nome, Latitude, Longitude, Contacto, Email, NumEscritorios FROM incubadora');
    $locations = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($locations);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
