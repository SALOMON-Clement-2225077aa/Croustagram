<?php

/**
 * Affiche la page de connexion à son profil sur pc
 */

require_once '../controllers/controllerPageConnexion.php';
require_once '../controllers/CroustagramGUI.php';

// On affiche le GUI de croustagram
Croustagram('Crousnexion', false);

session_start();
// On vérifie si il y a des erreurs de la connexion précédente
if (isset($_SESSION['tabErreurs'])) connexion_page($_SESSION['tabErreurs']);
else connexion_page();
?>
    </body>
