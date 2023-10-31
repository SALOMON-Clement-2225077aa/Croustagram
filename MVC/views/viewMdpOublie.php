<?php

/**
 * Affiche la page de mot de passe oublié sur pc avec laquelle un email est envoyé à l'adresse email renseignée
 */


require '../controllers/controllerMdpOublie.php';
require '../controllers/CroustagramGUI.php';

Croustagram('Mot de passe oublié', false);

mdpOublie();

?>

</body>

