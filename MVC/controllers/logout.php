<?php
    /**
     * Fichier qui déconnecte l'utilisateur à l'appel et renvoie sur la page d'accueil
     */

    // On détruit la session, tout simplement
    session_destroy();
    // Puis on redirige
    header("Location: ../views/viewMainPage.php");
    exit();