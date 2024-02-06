<?php

/**
 * Affiche la page de création de compte sur mobile
 */

require_once '../controllers/CroustagramGUI_Mobile.php';
require_once '../controllers/controllerCreateAccount.php';

$_SESSION['currentUrl'] = $_SERVER['REQUEST_URI'];
if (isset($_SESSION['suid'])) header('Location :' . $_SESSION['currentUrl']);

start_page('Crouscription');

showAccountPage();

end_page();