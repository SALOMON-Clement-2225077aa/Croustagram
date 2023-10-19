<?php
require_once '../controllers/CroustagramGUI_Mobile.php';
require_once '../controllers/controllerPoste.php';

session_start();
start_page('Croustaccueil');

showAllPosts();

end_page();
