<?php
require_once '../config/connectDatabase.php';

// Connexion à la base de donnée
$connexion = connexion();

function getOnePostData($id){
    global $connexion;

    // Requête
    $requete = 'SELECT * FROM croustapost ORDER BY ptsCrous DESC';
    $result = $connexion->query($requete);

    if ($result) {
        return $result;
    }
    return null;

}



function getNbCommentaireData($id){
    global $connexion;

    // Requête COMMENTAIRES
    $requete = 'SELECT COUNT(*) FROM croustacomm WHERE croustapost_id = ' . $id;
    $result = $connexion->query($requete);

    if ($result){
        return $result;
    }
    return null;
}

function getAllPostsDataaa(){
    global $dbLink;

}
