<?php

/**
 * Affiche la page d'accueil sur pc où on peut visualiser les post et les trier avec la barre de recherche
 */

require_once '../controllers/CroustagramGUI.php';
require_once '../controllers/controllerPost.php';

// On affiche le GUI de croustagram
Croustagram('Croustaccueil');

$_SESSION['currentUrl'] = $_SERVER['REQUEST_URI'];

// On affiche les posts
echo '<section id="posts">';
echo '<article id="post">';

// On tri en fonction du choix
if(isset($_POST['categorie'])) {
    afficherPostSelonCategorie($_POST['categorie']);
}
else if(isset($_POST['recherche'])) {
    afficherPostSelonMot(htmlspecialchars($_POST['recherche']));
}
// On affiche une recherche (ou non)
else {
    if(isset($_POST['tri'])) {
        echo showAllPosts($_POST['tri']);
    }
    else {
        showAllPosts();
    }
}
?>
</article>
</section>
</body>