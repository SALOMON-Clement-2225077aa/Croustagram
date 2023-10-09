<?php
require_once '../config/connectDatabase.php';

// Connexion à la base de donnée
$connexion = connexion();

function getLeaderboardData(){
    global $connexion;

    // Requête
    $requete = 'SELECT * FROM croustagrameur ORDER BY ptsCrous DESC';
    $result = $connexion->query($requete);

    // Si la requête a marché on affiche les users
    if ($result) {
        return $result;
    }
    return null;
}