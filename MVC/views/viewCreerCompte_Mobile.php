<?php

require '../controllers/CroustagramGUI_Mobile.php';
require '../controllers/controllerCreateAccount.php';

if (isset($_SESSION['suid'])) header('Location :' . $_SESSION['currentUrl']);

start_page('Crousnexion');

showAccountPage();

end_page();