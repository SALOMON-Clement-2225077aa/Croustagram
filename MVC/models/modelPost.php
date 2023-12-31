<?php
require_once '../config/connectDatabase.php';

// Connexion à la base de donnée
$connexion = connexion();

/**
 * Récupère toute les données d'un post (avec requete sql)
 * @param $id = id du post
 */
function getOnePostData($id){
    global $connexion;

    // Requête
    $requete = 'SELECT * FROM croustapost WHERE id=' . $id . " ORDER BY ptsCrous DESC";
    $result = $connexion->query($requete);

    if ($result) {
        return $result;
    }
    return null;

}

/**
 * Récupère toute le nb de commentaires d'un post (avec requete sql)
 * @param $id = id du post
 */
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

/**
 * Récupère tout les id des posts (avec requete sql) triées selon le paramètre (de base par points)
 * @param $ordre = l'ordre d'affichage des données
 */
function getAllPostsId($ordre = 'id'){
    global $connexion;

    // Requête
    $requete = 'SELECT id FROM croustapost ORDER BY ' . $ordre . ' DESC';
    $result = $connexion->query($requete);

    if ($result) {
        return $result;
    }
    return null;
}