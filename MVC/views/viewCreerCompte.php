<?php

require '../controllers/CroustagramGUI.php';
require '../controllers/controllerCreateAccount.php';

if (isset($_SESSION['suid'])) header('Location :' . $_SESSION['currentUrl']);

showAccountPage();

Croustagram('Crouscription', false);