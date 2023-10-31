<?php

/**
 * Affiche la page de création de post sur mobile
 */

require_once '../controllers/CroustagramGUI_Mobile.php';
require_once '../controllers/controllerCreatePost.php';

start_page('Créer un Croustapost');

showCreatePostPage();

end_page();

?>