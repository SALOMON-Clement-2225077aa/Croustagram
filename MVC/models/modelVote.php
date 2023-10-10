<?php
require_once '../config/connectDatabase.php';

// Connexion à la base de donnée
$connexion = connexion();
function upVote($post_ID) : void
{
    global $connexion;

    // Requête
    $requete = 'UPDATE croustapost SET ptsCrous = ptsCrous + 1 WHERE id = ' . $post_ID;
    $connexion->exec($requete);

    header('Location: ../views/viewMainPage.php');
}
function downVote($post_ID) : void
{
    global $connexion;

    // Requête
    $requete = 'UPDATE croustapost SET ptsCrous = ptsCrous - 1 WHERE id = ' . $post_ID;
    $connexion->exec($requete);

    header('Location: ../views/viewMainPage.php');
}
