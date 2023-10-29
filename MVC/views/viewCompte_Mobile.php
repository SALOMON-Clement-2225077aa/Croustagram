<?php

require_once '../controllers/CroustagramGUI_Mobile.php';
require_once '../controllers/controllerCompte.php';
require_once '../controllers/newProfilePicture.php';

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
        <article>
            <?php
                showCompte($id);

                echo showPosts($id);

            ?>
        </article>
    </section>
</body>
<?php
    end_page();
?>