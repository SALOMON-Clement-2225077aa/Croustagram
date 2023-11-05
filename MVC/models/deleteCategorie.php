<?php

require_once '../config/connectDatabase.php';
require_once '../models/modelAdmin.php';

$connexion = connexion();
session_start();

// Supprimer une catégorie :
// DELETE FROM croustegorie WHERE id = x

if($_GET['categorieID'] != null){
    // On vérifie que l'auteur du compte soit bien un admin
    if(isAdmin($_SESSION['username'])) {
        $req = 'DELETE FROM croustegorie WHERE id=' . $_GET['categorieID'];
        $connexion->exec($req);
    }
    header("Location: ../views/viewCreerCategorie.php");
}

// Bouton suppr catégorie :
// onclick="window.location.href = ' . '\'../models/deleteCategorie.php?categorieID=' . $idCat . '\'">