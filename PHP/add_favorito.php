<?php
require_once '../config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $totalCost = trim(preg_replace(['/<[^>]*>/','/\s+/'],' ', $_POST['totalCost'])) ?? '';
    $escritorioSelect = $_POST['escritorio'] ?? '';
    $markerSelect = $_POST['marker'] ?? '';
    echo "$totalCost $escritorioSelect $markerSelect ".$_SESSION['user_id']."";
    if ($totalCost && $escritorioSelect && $markerSelect) {
        $pdo = new PDO("mysql:host=$_dbhost;dbname=$_dbname", $_dbusername, $_dbpassword);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
            $stmt = $pdo->prepare("INSERT INTO favoritos (Calculos, IDEscritorio, IDUtilizador) VALUES (:calculos, :escritorio, :idutilizador)");
            $stmt->bindParam(':calculos', $totalCost);
            $stmt->bindParam(':escritorio', $escritorioSelect);
            $stmt->bindParam(':idutilizador', $_SESSION['user_id']);
            $stmt->execute();
            header('Location: ../index.php?page=search&success=Pesquisa guardada com sucesso!');
            exit;
        } catch (PDOException $e) {
            header('Location: ../index.php?page=search&error=Erro ao guardar pesquisa: ' . urlencode($e->getMessage()));
            exit;
        }
    } else {
        header('Location: ../index.php?page=search&error=Por favor, preencha todos os campos antes de guardar.');
        exit;
    }
} else {
    header('Location: ../index.php?page=search');
    exit;
}
header('Location: ../index.php?page=search');
    exit;
?>
