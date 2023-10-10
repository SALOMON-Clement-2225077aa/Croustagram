<?php
require_once '../config/connectDatabase.php';
    session_start();
    $commentContent = htmlspecialchars($_POST['commentContent']);

    $today = date('Y-m-d');

    $connexion = connexion();

    $query = 'INSERT INTO croustacomm (texte, date, croustagrameur_id, croustapost_id, pts_crous) VALUES ("' .  $commentContent . '", "' . $today . '", "' . $_SESSION['username'] . '", "' . $_GET['id'] . '", 0)';

    if (!($dbResult = $connexion->exec($query))) {
        echo '<strong>Erreur dans requête</strong><br>';
        // Affiche le type d'erreur.
        echo '<strong>Erreur : ' . $connexion->errorInfo() . '</strong><br>';
        // Affiche la requête envoyée.
        echo '<strong>Requête : ' . $query . '</strong><br>';
        exit();
    }

    header("Location: ../../views/viewPoste.php?id=" . $_GET['id']);
    exit();