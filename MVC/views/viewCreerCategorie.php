<?php

/**
 * Affiche la page de création de Catégorie sur pc
 */

require_once '../controllers/CroustagramGUI.php';
require_once '../controllers/controllerCreateCategorie.php';
require_once '../models/modelAdmin.php';

// Page réservé aux administrateurs donc redirection vers accueil
// Si un User non-admin essaie de se connecter

// On affiche le GUI de croustagram
Croustagram('Création d\'une Croustégorie', false, false);

if(isset($_SESSION['username'])){

    if(isAdmin($_SESSION['username'])){

        // On affiche l'interface de création des catégories
        showCreateCategorie();

    }
    else {
        // Retour vers la page d'accueil
        header("Location: ../views/viewMainPage.php");
    }
}
else {
    // Retour vers la page d'accueil
    header("Location: ../views/viewMainPage.php");
}