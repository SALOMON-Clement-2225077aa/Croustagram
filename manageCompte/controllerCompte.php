<?php
require '../ComputerView/utils.inc.php';
require 'modelCompte.php';

function getNbCommentaires($id){
    $nb_comm_result = getNbCommentaireData($id);
    $nb_comm = (int)$nb_comm_result['COUNT(*)']; // Convert to integer
    return $nb_comm;
}

function showPosts($id){

    $result = getPostData($id);
    $posts = ' ';

    // afficher_post($croustagrameur, $titre, $message, $date, $categorie, $ptsCrous):
    while ($row = mysqli_fetch_assoc($result)) {
        $nb_comm = getNbCommentaires($row['id']);
        $posts = $posts . afficher_post($row['croustagrameur_id'], $row['titre'], $row['message'], $row['date'], $row['categorie1'], $row['categorie2'], $row['categorie3'], $row['ptsCrous'], $row['id'], $nb_comm);
    }
    // Libère la variable
    mysqli_free_result($result);

    var_dump($posts);

    return $posts;
}