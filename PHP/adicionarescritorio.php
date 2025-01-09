<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
header('Content-Type: application/json');
$servername = "localhost";
    $username = "root";
    $password_db = "";
    $dbname = "sad";
	$conn = new mysqli($servername, $username, $password_db, $dbname);
	if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao']) && $_POST['acao'] === 'adicionar') { 
    $numero = isset($_POST['officeNumber']) ? $_POST['officeNumber'] : null;
    $tamanho = isset($_POST['officeSize']) ? $_POST['officeSize'] : null;
    $preco = isset($_POST['officePrice']) ? $_POST['officePrice'] : null;
    $idIncubadora = isset($_POST['officeIncubator']) ? $_POST['officeIncubator'] : null;
    $disponibilidade = isset($_POST['officeAvailability']) ? $_POST['officeAvailability'] : null;

    $sql = "INSERT INTO escritorio (IDIncubadora, Tamanho,Preco,Disponibilidade,Numero) VALUES ($idIncubadora, $tamanho, $preco, $disponibilidade, $numero);";
    $stmt = $conn->prepare($sql);
} else {
    $resposta = array(
        'status' => 'error',
        'message' => 'Requisição inválida ou ação incorreta.'
    );
    echo json_encode($resposta);
}
?>