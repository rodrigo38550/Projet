<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <title>Page de connexion</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="main.css" media="screen" type="text/css" />
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <main class="main">
        <div class="container">
            <h1>Connexion</h1>
            <form method="post" id="form-el" class="form col" action="Admin.php">
                <label for="username">Nom d'utilisateur :</label>
                <input type="text" id="username" name="username" required><br><br>
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" required><br><br>
                <input type="submit" value="Se connecter">
            </form>
        </div>
    </main>
</body>

</html>