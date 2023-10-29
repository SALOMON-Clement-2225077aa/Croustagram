<?php


require '../controllers/controllerResetMdp.php';
require '../controllers/CroustagramGUI.php';
require '../controllers/CroustagramGUI_Mobile.php';

$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));

session_start();
if (!isset($_GET['suid']) or !isset($_GET['accountId']) or ($_GET['suid'] !== $_SESSION['suid'])) header('Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley');

if ($isMob) {
    start_page('Mot de passe oublié');
    resetMdp();
    end_page();
}
else {
    Croustagram('Mot de passe oublié', false);
    resetMdp();
}