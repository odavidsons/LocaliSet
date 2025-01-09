<?php
    require_once '../config.php';
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $contacto = $_POST["contacto"];

    $servername = $_dbhost;
    $username = $_dbusername;
    $password_db = $_dbpassword;
    $dbname = $_dbname;

    $conn = new mysqli($servername, $username, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Verificar se o email ou contacto já existem
    $sql = "SELECT * FROM utilizadores WHERE Email = ? OR Contactotelef = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $email, $contacto);
    $stmt->execute();
    $result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Email ou contacto já existentes
    echo "<script>
            alert('O email ou contacto telefónico já estão cadastrados.');
            window.location.href = '../index.php?page=signup'; // Redirecionar de volta ao formulário
          </script>";

    }else{

    
    $sql = "INSERT INTO utilizadores (Nome, Email,Password,Contactotelef) VALUES (?, ?, ?, ?);";
    $stmt = $conn->prepare($sql);

    // Verifica se a declaração foi preparada corretamente
    if ($stmt) {
    // Vincula os parâmetros
    $stmt->bind_param("sssi", $nome, $email, $password, $contacto);

    // Executa a declaração
    if ($stmt->execute()) {
        echo "<script>
            alert('Utilizador registrado com sucesso.');
            window.location.href = '../index.php?page=login';
          </script>";
    } else {
        echo "<script>
            alert('Ocorreu um erro a registar o utilizador, tente novamente mais tarde.');
            window.location.href = '../index.php?page=signup';
          </script>";
    }
    }
    }
    $stmt->close();
    $conn->close();

?>