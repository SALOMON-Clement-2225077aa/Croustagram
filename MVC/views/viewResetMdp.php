<?php


require '../controllers/controllerResetMdp.php';
require '../controllers/CroustagramGUI.php';

session_start();
//if (!isset($_GET['suid']) or !isset($_GET['accountId']) or ($_GET['suid'] !== $_SESSION['suid'])) header('Location: https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley');

Croustagram('Mot de passe oublié', false);

resetMdp();