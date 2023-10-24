<?php

require '../controllers/controllerCompte.php';
require '../controllers/CroustagramGUI.php';
require '../controllers/newProfilePicture.php';

Croustagram('Croustagrammeur');
?>
<body>
    <section id="posts">
        <article>
<?php

$_SESSION['currentUrl'] = $_SERVER['REQUEST_URI'];

$id = $_GET['id'];

echo showCompte($id);

// J'ai commencé à faire l'host des photos de profil mais jpp essayez vous mêmes
//echo uploadPfp();

echo showPosts($id);
?>
</article>
    </section>
</body>