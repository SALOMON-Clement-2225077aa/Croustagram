<?php

require_once '../config/connectDatabase.php';
require_once '../models/modelAdmin.php';

$connexion = connexion();
session_start();

// Supprimer un compte :
// DELETE FROM croustagrameur WHERE id = 'abc';

if($_GET['userId'] != null){
    // On vérifie que l'auteur du compte soit bien l'user connecté (ou un admin)
    if($_GET['userId'] === $_SESSION['username'] or isAdmin($_SESSION['username'])) {
        $connexion->exec('DELETE FROM croustagrameur WHERE id=' . $_GET['userId']);
        header("Location: ../views/viewMainPage.php");
        exit();
    }
}
