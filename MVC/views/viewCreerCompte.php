<?php

/**
 * Affiche la page de création de compte sur pc
 */

require_once '../controllers/CroustagramGUI.php';
require_once '../controllers/controllerCreateAccount.php';

if (isset($_SESSION['suid'])) header('Location :' . $_SESSION['currentUrl']);

// On affiche l'interface de création de compte
showAccountPage();

// On affiche le GUI de croustagram
Croustagram('Crouscription', false);
?>
</body>