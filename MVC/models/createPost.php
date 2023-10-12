<?php
require_once '../config/connectDatabase.php';
session_start();

$titleContent = htmlspecialchars($_POST['titleContent']);
$postContent = htmlspecialchars($_POST['postContent']);

$today = date('Y-m-d');

$connexion = connexion();

$query = 'INSERT INTO croustapost (croustagrameur_id, titre, message, date) VALUES ("' .  $_SESSION['username'] . '", "' . $titleContent . '", "'  . $postContent . '", "' . $today . '")';

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