<?php
require_once '../config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['removeFavorite'])) {
    $favoriteIdToRemove = $_POST['favoriteId'];
    $pdo = new PDO("mysql:host=$_dbhost;dbname=$_dbname", $_dbusername, $_dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Prepare and execute the deletion query
    $deleteStmt = $pdo->prepare("DELETE FROM favoritos WHERE ID = :favoriteId");
    $deleteStmt->execute(['favoriteId' => $favoriteIdToRemove]);

    // Redirect to the same page to refresh the table after removal
    header("Location: ../index.php?page=favourites");
    exit;
}
header('Location: ../index.php?page=favourites');
    exit;
?>
