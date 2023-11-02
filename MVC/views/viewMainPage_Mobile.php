<?php

/**
 * Affiche la page d'accueil sur mobile où on peut visualiser les post et les trier avec la barre de recherche
 */


require_once '../controllers/CroustagramGUI_Mobile.php';
require_once '../controllers/controllerPost.php';

start_page('Croustaccueil');

$_SESSION['currentUrl'] = $_SERVER['REQUEST_URI'];

if(isset($_POST['categorie'])) {
    var_dump($_POST['categorie']);
    afficherPostSelonCategorie($_POST['categorie']);
}
else if(isset($_POST['recherche'])) {
    afficherPostSelonMot(htmlspecialchars($_POST['recherche']));
}
else {
    if(isset($_POST['tri'])) {
        echo showAllPosts($_POST['tri']);
    }
    else {
        showAllPosts();
    }
}

end_page();
