<<?php
require 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $query = "SELECT * FROM users WHERE username = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header('Location: acceuille.php');
    } else {
        echo 'Nom d\'utilisateur ou mot de passe incorrect.<br/>Veuillez saisir les identifiants correctes ou veuillez vous inscrire si ce n\'est pas le cas.';
        echo '<button><a href="register.php">Inscription</a></button>';
    }
}
?>
