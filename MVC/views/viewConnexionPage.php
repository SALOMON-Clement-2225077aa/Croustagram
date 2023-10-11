<?php
require '../controllers/controllerPageConnexion.php';
require '../controllers/CroustagramGUI.php';
?>
<link rel="stylesheet" href="../public/assets/styles/computer/style.css">

<?php
session_start();
if (isset($_SESSION['tabErreurs'])) connexion_page($_SESSION['tabErreurs']);
else connexion_page();
Croustagram('Crousnection', false);
?>