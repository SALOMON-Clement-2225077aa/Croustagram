<?php

require '../controllers/controllerMdpOublie.php';
require '../controllers/CroustagramGUI_Mobile.php';

start_page('Mot de passe oublié');

mdpOublie();

end_page();