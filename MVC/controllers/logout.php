<?php
    /**
     * Fichier qui déconnecte l'utilisateur à l'appel et renvoie sur la page d'accueil
     */
    session_start();
    session_destroy();
    header("Location: ../views/viewMainPage.php");
    exit();