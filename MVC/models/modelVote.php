<?php
require_once '../config/connectDatabase.php';

// Connexion à la base de donnée
$connexion = connexion();
function upVote($post_ID) : void
{
    global $connexion;

    // Requête
    $requete = 'INSERT INTO croustavote (croustagrameur_id, croustapost_id, up_vote, down_vote) VALUES (' . '\'' . $_SESSION['username'] . '\', ' . $post_ID . ', '  . 1 . ', ' . 0 . ')';

    if(dejaVote($_SESSION['username'],$post_ID) == 0) {
        $connexion->exec($requete);
        $connexion->exec('UPDATE croustapost SET ptsCrous = ptsCrous + 1 WHERE id = ' . $post_ID);
    }

    session_start();
    header('Location: ' . $_SESSION['currentUrl']);
}
function downVote($post_ID) : void
{
    global $connexion;

    // Requête
    $requete = 'INSERT INTO croustavote (croustagrameur_id, croustapost_id, up_vote, down_vote) VALUES (' . '\'' . $_SESSION['username']. '\', ' . $post_ID . ', '  . 0 . ', ' . 1 . ')';

    if(dejaVote($_SESSION['username'],$post_ID) == 0) {
        $connexion->exec($requete);
        $connexion->exec('UPDATE croustapost SET ptsCrous = ptsCrous - 1 WHERE id = ' . $post_ID);
    }

    session_start();
    header('Location: ' . $_SESSION['currentUrl']);
}

function dejaVote($croustagrameur_id, $croustapost_id) {
// Test si un utilisateur a déja intéragie avec un post

    global $connexion;

    // Requête
    $reqDejaVote = 'SELECT COUNT(*) FROM croustavote WHERE croustagrameur_id = \'' . $croustagrameur_id . '\' ' . 'AND croustapost_id = ' . $croustapost_id;
    $boolDejaVote = $connexion->query($reqDejaVote);
    $boolDejaVote = $boolDejaVote->fetch();

    return $boolDejaVote[0];
}