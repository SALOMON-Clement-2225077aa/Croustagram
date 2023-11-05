<?php

/**
 * Affiche la page de création de post sur pc
 */

require_once '../controllers/CroustagramGUI.php';
require_once '../controllers/controllerCreatePost.php';

// On affiche le GUI de croustagram
Croustagram('Création d\'un Croustapost', false, false);

// On affiche l'interface de création des posts
showCreatePostPage();