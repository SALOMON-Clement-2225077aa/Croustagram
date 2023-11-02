<?php
require_once '../config/connectDatabase.php';

// Connexion à la base de donnée
$connexion = connexion();

/**
 * Renvoie tout posts de l'utilisateur en paramètre
 * @param $accountName = nom du compte
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
 * @param $accountName
 * @return string
 * Renvoie le lien de la photo de profil du compte en paramètre
 */
function getImgCompte($accountName){
    $CompteData = getAllCompteData($accountName);
    $CompteData = $CompteData->fetch(PDO::FETCH_ASSOC);
    return $CompteData['img'];
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