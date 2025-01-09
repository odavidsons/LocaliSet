<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="include/css/style.css">
</head>
<body>
    <div class="content">
    <div class="container-centered">
    <div class="login-container">
        <form class="login-form" action="PHP/Log-inback.php" method="POST">
            <h2>Login</h2>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" placeholder="Email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <div style="text-align: center; margin-top: 10px;">
                <button type="submit" class="login-button">Log In</button>
            </div>
        </form>
        <div style="text-align: center; margin-top: 30px;">
            <button class="register-button" onclick="window.location.href='index.php?page=signup'">Registar</button> 
        </div>    
    </div></div></div>
</body>
</html>