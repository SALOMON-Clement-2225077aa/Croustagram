<?php
require_once '../config/connectDatabase.php';

// Connexion à la base de donnée
$connexion = connexion();

/**
 * @param $id_post
 * Récupère tout commentaire du post en paramètre (avec requete sql)
 */
function getAllCommentaires($id_post){
    global $connexion;

    // Requête
    $requete = 'SELECT * FROM croustacomm WHERE croustapost_id = \'' . $id_post . '\'';
    $result = $connexion->query($requete);

    if ($result){
        return $result;
    }
    return null;
}