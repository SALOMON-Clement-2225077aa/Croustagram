<?php
require_once '../config/connectDatabase.php';

// Connexion à la base de donnée
$connexion = connexion();
function upVote($post_ID) : void
{
    global $connexion;

    // Requête
    $requete = 'INSERT INTO croustavote (croustagrameur_id, croustapost_id, up_vote, down_vote) VALUES (' . '\'' . $_SESSION['username']. '\', ' . $post_ID . ', '  . 1 . ', ' . 0 . ')';
    echo $requete;

    $connexion->exec($requete);

    session_start();
    header('Location: ' . $_SESSION['currentUrl']);
}
function downVote($post_ID) : void
{
    global $connexion;

    // Requête
    $requete = 'INSERT INTO croustavote (croustagrameur_id, croustapost_id, up_vote, down_vote) VALUES (' . '\'' . $_SESSION['username']. '\', ' . $post_ID . ', '  . 0 . ', ' . 1 . ')';

    $connexion->exec($requete);

    session_start();
    header('Location: ' . $_SESSION['currentUrl']);
}