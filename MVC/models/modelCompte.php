<?php
require_once '../config/connectDatabase.php';

// Connexion à la base de donnée
$connexion = connexion();

function getAllPostsOfUserData($accountName){
    global $connexion;
    // Lecture des posts de la BD (SELECT * FROM `croustapost`)

    // Requête
    $requete = 'SELECT * FROM croustapost WHERE croustagrameur_id="' . $accountName . '" ORDER BY ptsCrous DESC';
    $result = $connexion->query($requete);

    if ($result) {
        return $result;
    }
    return null;
}

function getAllCompteData($accountName){
    global $connexion;
    // Lecture des infos du compte de la BD

    // Requête
    $requete = 'SELECT * FROM croustagrameur WHERE id="' . $accountName . '"';
    $result = $connexion->query($requete);

    if ($result) {
        return $result;
    }
    return null;
}