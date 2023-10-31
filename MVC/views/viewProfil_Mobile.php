<?php

/**
 * Affiche la page de visualisation de son propre profil sur mobile
 */


require_once '../controllers/controllerCompte.php';
require_once '../controllers/CroustagramGUI_Mobile.php';
require_once '../controllers/newProfilePicture.php';

start_page('Mon profil');
?>
    <div id="contenuPage">

        <?php
        $_SESSION['currentUrl'] = $_SERVER['REQUEST_URI'];

        $id = $_SESSION['username'];

        showCompte($id);

        echo '<button id="boutonDeconnexion" onclick="window.location.href = \'../controllers/logout.php\'"> Se déconnecter </button>';

        echo showPosts($id);

        end_page();
        ?>

    </div>
</body>