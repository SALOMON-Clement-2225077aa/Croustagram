<?php
require_once '../controllers/CroustagramGUI.php';
require '../controllers/controllerPoste.php';

Croustagram('Accueil');

echo '<section id="posts">';
echo '<article class="post">';



echo showAllPosts();

echo '</article>';
echo '</section>';