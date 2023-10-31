<?php

/**
 * Affiche la page de connexion à son profil sur pc
 */

require_once '../controllers/controllerPageConnexion.php';
require_once '../controllers/CroustagramGUI.php';

Croustagram('Crousnexion', false);

session_start();
if (isset($_SESSION['tabErreurs'])) connexion_page($_SESSION['tabErreurs']);
else connexion_page();
?>
    </body>
