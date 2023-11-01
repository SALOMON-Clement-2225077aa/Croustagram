<?php
require_once '../config/connectDatabase.php';

// Connexion à la base de donnée
$connexion = connexion();

/**
 * @param $post_ID
 * @return void
 * Augmente de 1 le score d'un post. Ajoute le vote dans la table vote.
 * Ou le supprime si le vote y été déjà (et donc enlèvre 1 point)
 */
function upVote($post_ID) : void
{
    global $connexion;

    // Requête
    $requete = 'INSERT INTO croustavote (croustagrameur_id, croustapost_id, up_vote, down_vote) VALUES (' . '\'' . $_SESSION['username'] . '\', ' . $post_ID . ', '  . 1 . ', ' . 0 . ')';

    // Insertion du vote dans la BdD et Update de pts
    $connexion->exec($requete);
    $connexion->exec('UPDATE croustapost SET ptsCrous = ptsCrous + 1 WHERE id = ' . $post_ID);

    session_start();
}

/**
 * @param $post_ID
 * @return void
 * Diminue de 1 le score d'un post. Ajoute le vote dans la table vote.
 * Ou le supprime si le vote y été déjà (et donc ajoute 1 point)
 */
function downVote($post_ID) : void
{
    global $connexion;

    // Requête
    $requete = 'INSERT INTO croustavote (croustagrameur_id, croustapost_id, up_vote, down_vote) VALUES (' . '\'' . $_SESSION['username']. '\', ' . $post_ID . ', '  . 0 . ', ' . 1 . ')';

    // Insertion du vote dans la BdD et Update de pts
    $connexion->exec($requete);
    $connexion->exec('UPDATE croustapost SET ptsCrous = ptsCrous - 1 WHERE id = ' . $post_ID);

    session_start();
}

/**
 * @param $croustagrameur_id
 * @param $croustapost_id
 * @return void
 * Supprime le vote d'un utilisateur sur un post
 */
function supprVote($croustagrameur_id, $croustapost_id) {

    global $connexion;

    $requete = 'DELETE FROM croustavote WHERE croustagrameur_id = \'' . $croustagrameur_id . '\' AND croustapost_id = ' . $croustapost_id ;
    $connexion->exec($requete);

}

/**
 * @param $post_ID
 * @param $plus
 * @param $moins
 * @return void
 * Permet d'augmenter ou diminuer le score d'un post
 * Je l'utilise quand par exemple j'enlève un UpVote :
 * Je supprime le vote de la table et je baisse le score du post de 1
 */
function updateScorePost($post_ID, $plus, $moins) {

    global $connexion;

    if($plus == 1) {
        $connexion->exec('UPDATE croustapost SET ptsCrous = ptsCrous + 1 WHERE id = ' . $post_ID);
    }
    if($moins == 1) {
        $connexion->exec('UPDATE croustapost SET ptsCrous = ptsCrous - 1 WHERE id = ' . $post_ID);
    }
}

/**
 * @param $croustagrameur_id
 * @param $croustapost_id
 * @param $up
 * @param $down
 * @return void
 * Test si un utilisateur a déja intéragie avec un post
 */
function dejaVote($croustagrameur_id, $croustapost_id, $up, $down) {

    global $connexion;

    // Requête
    $reqDejaVote = 'SELECT COUNT(*) FROM croustavote WHERE croustagrameur_id = \'' . $croustagrameur_id . '\' ' . 'AND croustapost_id = ' . $croustapost_id . ' AND up_vote = ' . $up . ' AND down_vote = ' . $down;
    $boolDejaVote = $connexion->query($reqDejaVote);
    $boolDejaVote = $boolDejaVote->fetch();

    return $boolDejaVote[0];
}

/**
 * @param $post_ID
 * @return void
 * Quand le bouton upVote est pressé cette fonction est appelée.
 * Elle vérifie si il y a dejà un vote de l'utilisateur sur le post,
 * Si non l'ajoute, modifie le score... Gère l'upvote en général
 */
function upVotePressed($post_ID) {

    $croustagrameur_id = $_SESSION['username'];

    $boolUp = dejaVote($croustagrameur_id,$post_ID,1,0);
    $boolDown = dejaVote($croustagrameur_id,$post_ID,0,1);

    echo $boolDown;
    echo $boolUp;

    if($boolUp == 1) {
        supprVote($croustagrameur_id,$post_ID);
        updateScorePost($post_ID,0,1);
    }
    else if ($boolDown == 1) {
        supprVote($croustagrameur_id,$post_ID);
        updateScorePost($post_ID,1,0);
        upVote($post_ID);
    }
    else {
        upVote($post_ID);
    }

    header('Location: ' . $_SESSION['currentUrl']);
}

/**
 * @param $post_ID
 * @return void
 * Quand le bouton downVote est pressé cette fonction est appelée.
 * Elle vérifie si il y a dejà un vote de l'utilisateur sur le post,
 * Si non l'ajoute, modifie le score... Gère le downVote en général
 */
function downVotePressed($post_ID) {

    $croustagrameur_id = $_SESSION['username'];

    $boolUp = dejaVote($croustagrameur_id,$post_ID,1,0);
    $boolDown = dejaVote($croustagrameur_id,$post_ID,0,1);

    if($boolUp == 1) {
        supprVote($croustagrameur_id,$post_ID);
        updateScorePost($post_ID,0,1);
        downVote($post_ID);
    }
    else if ($boolDown == 1) {
        supprVote($croustagrameur_id,$post_ID);
        updateScorePost($post_ID,1,0);
    }
    else {
        downVote($post_ID);
    }

    header('Location: ' . $_SESSION['currentUrl']);
}