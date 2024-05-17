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
            header('Location: acceuille.php');
            exit();
        } else {
            echo 'Erreur lors de la publication du tweet.';
        }
    } else {
        echo 'Le contenu du tweet ne peut pas être vide.';
    }
}

// Traiter les "likes" et "dislikes"
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && isset($_POST['tweet_id'])) {
    $tweet_id = $_POST['tweet_id'];
    $action = $_POST['action'];

    // Vérifier si l'utilisateur a déjà "liké" ou "disliké" ce tweet
    $query = "SELECT * FROM likes_dislikes WHERE tweet_id = ? AND user_id = ?";
    $stmt = $connexion->prepare($query);
    $stmt->execute([$tweet_id, $user_id]);
    $existing = $stmt->fetch();

    if ($existing) {
        // Mise à jour du "like" ou "dislike"
        $query = "UPDATE likes_dislikes SET type = ? WHERE id = ?";
        $stmt = $connexion->prepare($query);
        $stmt->execute([$action, $existing['id']]);
    } else {
        // Insertion d'un nouveau "like" ou "dislike"
        $query = "INSERT INTO likes_dislikes (tweet_id, user_id, type) VALUES (?, ?, ?)";
        $stmt = $connexion->prepare($query);
        $stmt->e
        xecute([$tweet_id, $user_id, $action]);
    }

    header('Location: home.php');
    exit();
}

// Récupérer tous les tweets et likes
$query = "SELECT tweets.*, users.username,
          (SELECT COUNT(*) FROM likes_dislikes WHERE tweet_id = tweets.id AND type = 'like') AS likes,
          (SELECT COUNT(*) FROM likes_dislikes WHERE tweet_id = tweets.id AND type = 'dislike') AS dislikes
          FROM tweets
          JOIN users ON tweets.user_id = users.id
          ORDER BY tweets.created_at DESC";
$stmt = $connexion->query($query);
$tweets = $stmt->fetchAll();
?>

