<?php
require_once '../config/connectDatabase.php';
session_start();

// Récup des inputs de la créarion du post (formulaire)
$titleContent = htmlspecialchars($_POST['titleContent']);
$postContent = htmlspecialchars($_POST['postContent']);
$numCat1 = $_POST['Cat1'];
$numCat2 = $_POST['Cat2'];
$numCat3 = $_POST['Cat3'];
// Date du jour :
$today = date('Y-m-d');

// Requête ajout du post à la BdD :
$connexion = connexion();
$query = 'INSERT INTO croustapost (croustagrameur_id, titre, message, date, categorie1, categorie2, categorie3) VALUES ("' .  $_SESSION['username'] . '", "' . $titleContent . '", "'  . $postContent . '", "' . $today . '", "' . $numCat1 . '", "' . $numCat2 . '", "' . $numCat3 . '")';

if (!($dbResult = $connexion->exec($query))) {
    echo '<strong>Erreur dans requête</strong><br>';
    // Affiche le type d'erreur.
    echo '<strong>Erreur : ' . $connexion->errorInfo() . '</strong><br>';
    // Affiche la requête envoyée.
    echo '<strong>Requête : ' . $query . '</strong><br>';
    exit();
}

header("Location: " . $_SESSION['currentUrl']);
exit();