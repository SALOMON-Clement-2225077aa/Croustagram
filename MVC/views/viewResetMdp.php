<?php

/**
 * Affiche la page de reset de mot de passe accessible depuis le mail recu suite à une demande de changement de mot de passe
 */

require '../controllers/controllerResetMdp.php';
require '../controllers/CroustagramGUI.php';
require '../controllers/CroustagramGUI_Mobile.php';

// La variable qui reconnait si on est sur mobile ou non
$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));

session_start();
if (!isset($_GET['suid']) or !isset($_GET['accountId']) or ($_GET['suid'] !== $_SESSION['suid'])) header('Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley');

// On vérifie si on est sur mobile, on affiche la page mobile
if ($isMob) {
    start_page('Mot de passe oublié');
    resetMdp();
    end_page();
}
// Et si on est sur pc ça affiche la page pc
else {
    Croustagram('Mot de passe oublié', false);
    resetMdp();
}