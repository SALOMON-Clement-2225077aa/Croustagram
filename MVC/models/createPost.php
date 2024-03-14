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

$url = "https://discord.com/api/webhooks/1217840158989090879/QPoLkBzLcA_9cQIXw1FYd5oXb-2DIhRK9kXiurDOLexOBtqsFhiVJGh2KyhjySh3Mg1z";

$headers = [ 'Content-Type: application/json; charset=utf-8' ];
$POST = [ 'username' => 'CroustaBot', 'content' =>  '||@everyone||' . "\r\n" . 'Il y a un nouveau post sur Croustagram !' . "\r\n" . '**Titre : **' . $titleContent . "\r\n" . 'https://thecroustagram.alwaysdata.net/MVC/views/viewCompte.php?id=' . $_SESSION['username']];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
$response = curl_exec($ch);
error_log($response);

if (!($dbResult = $connexion->exec($query))) {
    echo '<strong>Erreur dans requête</strong><br>';
    // Affiche le type d'erreur.
    echo '<strong>Erreur : ' . $connexion->errorInfo() . '</strong><br>';
    // Affiche la requête envoyée.
    echo '<strong>Requête : ' . $query . '</strong><br>';
    exit();
}

header("Location: ../views/viewMainPage.php");
exit();