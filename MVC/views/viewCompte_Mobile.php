<?php

/**
 * Affiche la page de visualisation du profil de quelqu'un sur mobile
 */

require_once '../controllers/CroustagramGUI_Mobile.php';
require_once '../controllers/controllerCompte.php';

$_SESSION['currentUrl'] = $_SERVER['REQUEST_URI'];
$id = $_GET['id'];

$title = 'Profil de ' . $id;
start_page($title);

# Si c'est mon profil je redirige vers ma page
if(isset($_SESSION['username'])) {
    if($id ==  $_SESSION['username']) {
        header("Location: ../views/viewProfil_Mobile.php");
    }
}

# Si non j'affiche le profil de l'utilisateur
?>
    <link rel="stylesheet" href="../../MVC/public/assets/styles/mobile/profil.css">
    @import "profil.css";
    <section id="contenuPage">
        <article id="PostUser">
            <?php
                showCompte($id);

                if(isset($_SESSION['username'])) {
                    if(isAdmin($_SESSION['username'])) {
                        echo '<button id="boutonSupprCompte" onclick="window.location.href = ' . '\'../models/deleteCompte.php?userId=' . $id . '\'"> Supprimer le compte </button>';
                    }
                }

                echo showPosts($id);

            ?>
        </article>
    </section>
</body>
<?php
    end_page();
?>