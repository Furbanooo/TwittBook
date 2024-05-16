<?php
    $server="localhost";
    $utilisateur="root";
    $motDePasse="";
    $baseDeDonnees="tweetbookdb";
 
 
    //créer  une connexion
    $connexion =new PDO("mysql:host=$server;dbname=$baseDeDonnees", $utilisateur, $motDePasse);
?>