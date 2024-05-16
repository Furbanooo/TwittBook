<?php
require 'config.php';

try {
    // Exécuter une requête simple pour vérifier la connexion
    $stmt = $connexion->query("SELECT 1");
    if ($stmt) {
        echo "Connexion réussie !";
    }
} catch (PDOException $e) {
    echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
}
?>
