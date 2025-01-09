<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="include/css/style.css">
</head>
<body>
    <div class="content">
    <div class="container-centered">
        <div class="register-container">
            <form id="formulario" class="login-form" action="PHP/registerback.php" method="POST">
                <h2>Registro</h2>

                <label for="nome">Primeiro e ultimo nome:</label>
                <input id="nome" name="nome" placeholder="Primeiro e ultimo nome" required>
    
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Email" required>

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Password" required>

                <label for="contacto">Contacto telefónico:</label>
                <input type="tel" id="contacto" name="contacto" placeholder="Contacto telefónico" pattern="^\d{9}$" required title="Introduza um contacto telefónico válido com 9 dígitos.">
                <div style="text-align: center; margin-top: 10px;">
                    <button type="submit" class="login-button">Criar conta</button>
                </div>
            </form>
            <div style="text-align: center; margin-top: 30px;">
                <button class="register-button" onclick="window.location.href='index.php?page=login'">Log-in</button> 
            </div>
        </div>
    </div></div>
</body>
</html>