<?php

/**
 * Affiche la page de mot de passe oublié sur pc avec laquelle un email est envoyé à l'adresse email renseignée
 */


require '../controllers/controllerMdpOublie.php';
require '../controllers/CroustagramGUI.php';

// On affiche le GUI de croustagram
Croustagram('Mot de passe oublié', false);

// On affiche l'interface du mdp oublié
mdpOublie();

?>

</body>

