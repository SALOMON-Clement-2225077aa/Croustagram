<?php
require_once '../controllers/CroustagramGUI_Mobile.php';
require_once '../controllers/controllerProfilPage_Mobile.php';

session_start();
start_page('Profil');
contenuProfil();

end_page();
