<?php

/**
 * Affiche la page de connexion à son profil sur mobile
 */

require_once '../controllers/CroustagramGUI_Mobile.php';
require_once '../controllers/controllerPageConnexion.php';
require_once '../controllers/controllerPageConnexion.php';

start_page('Crousnexion');

if (isset($_SESSION['tabErreurs'])) connexion_page($_SESSION['tabErreurs']);
else connexion_page();

end_page();
?>
</body>
