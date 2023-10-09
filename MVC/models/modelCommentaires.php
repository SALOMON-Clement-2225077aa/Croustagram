<?php
require_once '../config/connectDatabase.php';

// Connexion à la base de donnée
$connexion = connexion();

function getAllCommentaires($id){
    global $connexion;

    // Requête
    $requete = 'SELECT * FROM croustacomm WHERE croustapost_id = \'' . $id . '\'';
    $result = $connexion->query($requete);

    if ($result){
        return $result;
    }
    return null;
}