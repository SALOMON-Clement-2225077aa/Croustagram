<?php
require_once '../config/connectDatabase.php';

// Connexion à la base de donnée
$connexion = connexion();

/**
 * @param $accountName
 * Renvoie tout posts de l'utilisateur en paramètre
 */
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

/**
 * @param $accountName
 * Recupère les donnée du compte associé à l'utilisateur en paramètre
 */
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

/**
 * @param $mail
 * Recupère les donnée du compte associé au mail en paramètre
 */
function getCompteDataByMail($mail){
    global $connexion;

    // Requête
    $requete = 'SELECT * FROM croustagrameur WHERE email="' . $mail . '"';
    $result = $connexion->query($requete);

    if ($result) {
        return $result;
    }
    return null;
}