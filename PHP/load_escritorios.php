<?php
header('Content-Type: application/json');

require_once '../config.php';

// Initialize response
$response = [];

try {
    // Get the Incubadora ID from the query string
    $incubadoraId = isset($_GET['incubadora_id']) ? intval($_GET['incubadora_id']) : 0;
    $pdo = new PDO("mysql:host=$_dbhost;dbname=$_dbname", $_dbusername, $_dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($incubadoraId > 0) {
        // Query to fetch available offices
        $stmt = $pdo->prepare('
            SELECT ID as id, Tamanho as tamanho, Preco as preco, Disponibilidade as disponibilidade, Numero as numero
            FROM escritorio
            WHERE IDIncubadora = :incubadora_id AND Disponibilidade = 1
        ');
        $stmt->execute(['incubadora_id' => $incubadoraId]);
        $response = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $response = ['error' => 'Invalid Incubadora ID'];
    }
} catch (PDOException $e) {
    // Handle database errors
    $response = ['error' => $e->getMessage()];
}

// Output the response as JSON
echo json_encode($response);
?>
