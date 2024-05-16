<?php
$server = "localhost";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "tweetbookdb";

// Créer une connexion avec PDO et gérer les erreurs
try {
    $connexion = new PDO("mysql:host=$server;dbname=$baseDeDonnees;charset=utf8", $utilisateur, $motDePasse, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);
} catch (PDOException $e) {
    // Afficher l'erreur et arrêter l'exécution
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
