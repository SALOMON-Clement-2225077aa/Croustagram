<?php

require_once '../controllers/controllerCompte.php';
require_once '../controllers/CroustagramGUI.php';
require_once '../controllers/newProfilePicture.php';

Croustagram('Croustagrammeur');
?>
    <section id="posts">
        <article>
<?php

$_SESSION['currentUrl'] = $_SERVER['REQUEST_URI'];

$id = $_GET['id'];

showCompte($id);

// J'ai commencé à faire l'host des photos de profil mais jpp essayez vous mêmes
//echo uploadPfp();

echo showPosts($id);
?>
</article>
    </section>
</body>