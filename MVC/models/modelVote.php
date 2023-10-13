<?php
require_once '../config/connectDatabase.php';

// Connexion à la base de donnée
$connexion = connexion();
function upVote($post_ID) : void
{
    global $connexion;

    // Requête
    $requete = 'INSERT INTO croustavote (croustagrameur_id, croustapost_id, up_vote, down_vote) VALUES (' . '\'' . $_SESSION['username'] . '\', ' . $post_ID . ', '  . 1 . ', ' . 0 . ')';

    // Insertion du vote dans la BdD et Update de pts
    $connexion->exec($requete);
    $connexion->exec('UPDATE croustapost SET ptsCrous = ptsCrous + 1 WHERE id = ' . $post_ID);

    session_start();
    header('Location: ' . $_SESSION['currentUrl']);
}
function downVote($post_ID) : void
{
    global $connexion;

    // Requête
    $requete = 'INSERT INTO croustavote (croustagrameur_id, croustapost_id, up_vote, down_vote) VALUES (' . '\'' . $_SESSION['username']. '\', ' . $post_ID . ', '  . 0 . ', ' . 1 . ')';

    // Insertion du vote dans la BdD et Update de pts
    $connexion->exec($requete);
    $connexion->exec('UPDATE croustapost SET ptsCrous = ptsCrous - 1 WHERE id = ' . $post_ID);

    session_start();
    header('Location: ' . $_SESSION['currentUrl']);
}

function dejaVote($croustagrameur_id, $croustapost_id, $up, $down) {
// Test si un utilisateur a déja intéragie avec un post

    global $connexion;

    // Requête
    $reqDejaVote = 'SELECT COUNT(*) FROM croustavote WHERE croustagrameur_id = \'' . $croustagrameur_id . '\' ' . 'AND croustapost_id = ' . $croustapost_id . ' AND up_vote = ' . $up . ' AND down_vote = ' . $down;
    $boolDejaVote = $connexion->query($reqDejaVote);
    $boolDejaVote = $boolDejaVote->fetch();

    return $boolDejaVote[0];
}

function upVotePressed($post_ID) {

    $croustagrameur_id = $_SESSION['username'];

    $boolUp = dejaVote($croustagrameur_id,$post_ID,1,0);
    $boolDown = dejaVote($croustagrameur_id,$post_ID,0,1);

    if($boolUp == 1) {
        // delete up vote
    }
    else if ($boolDown == 1) {
        // delete down vote
        // up vote
    }
    else {
        // up vote
    }
}

function downVotePressed($post_ID) {

    $croustagrameur_id = $_SESSION['username'];

    $boolUp = dejaVote($croustagrameur_id,$post_ID,1,0);
    $boolDown = dejaVote($croustagrameur_id,$post_ID,0,1);

    if($boolUp == 1) {
        // delete up vote
        // down vote
    }
    else if ($boolDown == 1) {
        // delete down vote
    }
    else {
        // down vote
    }
}