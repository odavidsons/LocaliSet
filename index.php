<?php
include('config.php');
require('PHP/dbconnect.php');

$page = $_GET['page'];

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="include/css/style.css">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <!-- Leaflet -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
    <!-- Ícons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>
    <!-- Icon style -->
    <style>
    .material-symbols-outlined {
    font-variation-settings:
    'FILL' 0,
    'wght' 400,
    'GRAD' 0,
    'opsz' 48
    }
    </style>
    <div class="header">
    <?php
    include('header.php');
    ?>
    </div>
    <div class="content">
        <?php
        if (isset($_SESSION['user_id'])) {
            //Display correct page according to url dynamically
            switch($page) {
                //Website pages
                case 'home':
                    include('pages/home.php');
                    break;
                case 'search':
                    include('pages/search.php');
                    break;
                case 'favourites':
                    include('pages/favourites.php');
                    break;
                case 'logout':
                    include('PHP/logout.php');
                    break;
                default:
                    include('pages/home.php');
                    break;
            }
        } else {
            switch($page) {
                //Website pages
                case 'login':
                    include('pages/Log-in.php');
                    break;
                case 'signup':
                    include('pages/Register.php');
                    break;
                default:
                    include('pages/Log-in.php');
                    break;
            }
        }
        ?>
    </div>
    <div class="footer text-center">
        <?php 
        include('footer.php');
        ?>
    </div>
</body>
</html>