<?php

require '../controllers/CroustagramGUI_Mobile.php';
require '../controllers/controllerCreateAccount.php';

if (isset($_SESSION['suid'])) header('Location :' . $_SESSION['currentUrl']);

start_page('Crouscription');

showAccountPage();

end_page();