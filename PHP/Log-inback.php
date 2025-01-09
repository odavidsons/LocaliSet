<?php
session_start();
require_once '../config.php';
$email = $_POST["email"];
$password = $_POST["password"];

    $servername = $_dbhost;
    $username = $_dbusername;
    $password_db = $_dbpassword;
    $dbname = $_dbname;

    $conn = new mysqli($servername, $username, $password_db, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

  // Verificar se o utilizador existe
  $testeemail = "SELECT * FROM utilizadores WHERE Email = ?";
  $stmt = $conn->prepare($testeemail);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $testepassword = "SELECT * FROM utilizadores WHERE Email = ? AND Password = ?";
        $stmt = $conn->prepare($testepassword);
        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if ($result->num_rows == 1) {
                // Login bem-sucedido
                $_SESSION['user_id'] = $row['ID'];         // Store user ID in session
                $_SESSION['username'] = $row['Nome'];
                echo $_SESSION['user_id'];
                if($email=="admin@gmail.com")
                {
                    $_SESSION['usertype'] = 1;
                    header("Location: ../pages/admin.php");
                }else{
                    $_SESSION['usertype'] = 0;
                    header("Location: ../index.php?page=search"); // Redireciona para uma página protegida
                }               
        } else{
            echo "<script>
            alert('Password introduzida inválida');
            window.location.href = '../index.php?page=login'; // Redirecionar de volta ao formulário
            </script>";
        }
    } else {
            echo "<script>
            alert('Email introduzido inválido');
            window.location.href = '../index.php?page=login'; // Redirecionar de volta ao formulário
            </script>";
        }

    $stmt->close();
    $conn->close();

?>