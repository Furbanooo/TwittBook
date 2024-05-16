<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
    $stmt = $connexion->prepare($query);

    if ($stmt->execute([$username, $email, $password])) {
        header('Location: acceuille.php');
    } else {
        echo 'Erreur lors de l\'inscription.';
    }
}
?>