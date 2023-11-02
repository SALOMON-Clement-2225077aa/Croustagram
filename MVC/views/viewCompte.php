<?php

/**
 * Affiche la page de visualisation du profil de quelqu'un sur pc
 */

require_once '../controllers/controllerCompte.php';
require_once '../controllers/CroustagramGUI.php';
// On prends l'id du compte
$id = $_GET['id'];
// On vérifie si on est sur mobile
$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
if($isMob){
    header("Location: ../views/viewCompte_Mobile.php?id=$id");
    die;
}
// On affiche le GUI de croustagram
Croustagram('Croustagrammeur');
?>
    <section id="posts">
        <article>
            <?php

            // On update la position de l'utilisateur
            $_SESSION['currentUrl'] = $_SERVER['REQUEST_URI'];

            // On affiche le compte
            showCompte($id);

            // On affiche les posts
            echo showPosts($id);
            ?>
        </article>
    </section>
</body>