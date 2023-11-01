<?php

/**
 * Affiche la page de visualisation du profil de quelqu'un sur pc
 */

require_once '../controllers/controllerCompte.php';
require_once '../controllers/CroustagramGUI.php';

$id = $_GET['id'];
$isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
if($isMob){
    header("Location: ../views/viewCompte_Mobile.php?id=$id");
    die();
}
Croustagram('Croustagrammeur');
?>
    <section id="posts">
        <article>
<?php

$_SESSION['currentUrl'] = $_SERVER['REQUEST_URI'];

showCompte($id);

// J'ai commencé à faire l'host des photos de profil mais jpp essayez vous mêmes
//echo uploadPfp();

echo showPosts($id);
?>
</article>
    </section>
</body>