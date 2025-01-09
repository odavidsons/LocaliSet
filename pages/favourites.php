<?php

if (!isset($_SESSION['username'])) {
    echo "<script type='text/javascript'>
            location = 'index.php?error=Acesso negado';
          </script>";
    exit();
}

$username = $_SESSION['username'];
$userId = $_SESSION['user_id'];

// Database connection
require_once 'config.php';

try {
    $pdo = new PDO("mysql:host=$_dbhost;dbname=$_dbname", $_dbusername, $_dbpassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch favorited offices for the logged-in user
    $stmt = $pdo->prepare("
        SELECT 
            e.Numero AS numero,
            e.Tamanho AS tamanho,
            i.Nome AS incubadora,
            f.Calculos AS calculos
        FROM favoritos f
        INNER JOIN escritorio e ON f.IDEscritorio = e.ID
        INNER JOIN incubadora i ON e.ID = i.ID
        WHERE f.IDUtilizador = :userId
    ");
    $stmt->execute(['userId' => $userId]);
    $favorites = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error = "Erro ao carregar favoritos: " . $e->getMessage();
    $favorites = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorited Offices</title>
    <style>
        

        .profile_content {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card {
            margin-bottom: 20px;
            background-color: #f8f9fa;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .card-title {
            font-size: 24px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="profile_content">
        <!-- Display alert messages -->
        <?php if (isset($_GET['error']) && $_GET['error'] != ""): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?= htmlspecialchars($_GET['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- User Welcome Card -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Bem vindo, <?= htmlspecialchars($username); ?>!</h5>
            </div>
        </div>

        <!-- Favorites Table -->
        <?php if (!empty($favorites)): ?>
            <table>
                <thead>
                    <tr>
                        <th>Localização</th>
                        <th>Nº Escritório</th>
                        <th>Tamanho (m²)</th>
                        <th>Calculos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($favorites as $favorite): ?>
                        <tr>
                            <td><?= htmlspecialchars($favorite['incubadora']); ?></td>
                            <td><?= htmlspecialchars($favorite['numero']); ?></td>
                            <td><?= htmlspecialchars($favorite['tamanho']); ?></td>
                            <td><?= htmlspecialchars($favorite['calculos']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Você não tem escritórios favoritos no momento.</p>
        <?php endif; ?>
    </div>
</body>
</html>
