<?php


require '../controllers/controllerResetMdp.php';
require '../controllers/CroustagramGUI_Mobile.php';

session_start();
if (!isset($_GET['suid']) or !isset($_GET['accountId']) or ($_GET['suid'] !== $_SESSION['suid'])) header('Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley');

start_page('Mot de passe oublié');

resetMdp();

end_page();