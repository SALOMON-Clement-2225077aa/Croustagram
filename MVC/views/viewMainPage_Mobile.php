<?php
require_once '../controllers/CroustagramGUI_Mobile.php';
require_once '../controllers/controllerPoste.php';

start_page('Croustaccueil');

if(isset($_POST['categorie'])) {
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
