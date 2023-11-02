<?php

require_once '../config/connectDatabase.php';
require_once '../models/modelAdmin.php';

$connexion = connexion();
session_start();

if($_GET['commId'] != null){
    // On vérifie que l'auteur du commentaire soit bien l'user connecté (ou un admin)
    $verifData = $connexion->query('SELECT croustagrameur_id FROM croustacomm WHERE id=' . $_GET['commId']);
    while($verif = $verifData->fetch(PDO::FETCH_ASSOC)){
        if ($verif['croustagrameur_id'] === $_SESSION['username'] or isAdmin($_SESSION['username'])) {
            // Si tout est bon , on supprime le commentaire
            $connexion->exec('DELETE FROM croustacomm WHERE id=' . $_GET['commId']);
            header("Location: ../views/viewPost.php?id=" . $_GET['postId']);
            exit();
        }
    }
}
else {
    // On vérifie que l'auteur du post soit bien l'user connecté (ou un admin)
    $verifData = $connexion->query('SELECT croustagrameur_id FROM croustapost WHERE id=' . $_GET['postId']);
    while ($verif = $verifData->fetch(PDO::FETCH_ASSOC)){
        if ($verif['croustagrameur_id'] === $_SESSION['username'] or isAdmin($_SESSION['username'])) {
            // Si tout est bon , on supprime le post
            $connexion->exec('DELETE FROM croustapost WHERE id=' . $_GET['postId']);
            header("Location: ../views/viewMainPage.php");
            exit();
        }
    }
}
