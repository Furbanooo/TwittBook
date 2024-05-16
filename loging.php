<?php
    require 'config.php';
    $statement=$connexion ->prepare("SELECT * FROM user");
    $statement -> execute();
 
 
    $tasks= $statement ->fetchAll();
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Connexion</h1>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="register.php">Inscription</a>
        </nav>
    </header>
    <main>
        <form action="login_process.php" method="post">
            <label for="username">Nom d'utilisateur :</label>
            <input type="text" id="username" name="username" required>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Se connecter</button>
        </form>
    </main>
</body>
</html>