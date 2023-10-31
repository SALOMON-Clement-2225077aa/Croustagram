<?php

/**
 * Affiche la page de mot de passe oublié sur mobile avec laquelle un email est envoyé à l'adresse email renseignée
 */

require '../controllers/controllerMdpOublie.php';
require '../controllers/CroustagramGUI_Mobile.php';

start_page('Mot de passe oublié');

mdpOublie();

end_page();