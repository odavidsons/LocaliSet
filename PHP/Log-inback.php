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
        $sql = "SELECT * FROM utilizadores WHERE Email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        if (($result->num_rows == 1) && password_verify($password, $row['Password'])) {
          
                // Login bem-sucedido
                $_SESSION['user_id'] = $row['ID'];         // Store user ID in session
                $_SESSION['username'] = $row['Nome'];
                echo $_SESSION['user_id'];
                if($row['Administrador'] == 1)
                {
                    $_SESSION['usertype'] = 1;
                    header("Location: ../index.php?page=adminPanel");
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