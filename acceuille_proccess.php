<?php
require 'config.php';
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Traiter le formulaire de publication de tweet
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];

    if (!empty($content)) {
        $query = "INSERT INTO tweets (user_id, content) VALUES (?, ?)";
        $stmt = $connexion->prepare($query);

        if ($stmt->execute([$user_id, $content])) {
            header('Location: home.php');
            exit();
        } else {
            echo 'Erreur lors de la publication du tweet.';
        }
    } else {
        echo 'Le contenu du tweet ne peut pas être vide.';
    }
}

// Récupérer tous les tweets
$query = "SELECT tweets.*, users.username FROM tweets JOIN users ON tweets.user_id = users.id ORDER BY tweets.created_at DESC";
$stmt = $connexion->query($query);
$tweets = $stmt->fetchAll();
?>