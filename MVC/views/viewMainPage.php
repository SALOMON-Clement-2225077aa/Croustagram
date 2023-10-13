<?php
require_once '../controllers/CroustagramGUI.php';
require '../controllers/controllerPoste.php';

Croustagram('Accueil');

$_SESSION['currentUrl'] = $_SERVER['REQUEST_URI'];

echo '<section id="posts">';
echo '<article class="post">';

if(isset($_POST['categorie'])) {
    afficherPostSelonCategorie($_POST['categorie']);
}
else if(isset($_POST['recherche'])) {
    afficherPostSelonMot(htmlspecialchars($_POST['recherche']));
}
else {
    echo showAllPosts();
}

echo '</article>';
echo '</section>';