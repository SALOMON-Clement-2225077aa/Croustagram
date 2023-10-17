<?php

require '../controllers/controllerCompte.php';
require '../controllers/CroustagramGUI.php';
require '../controllers/newProfilePicture.php';

Croustagram('Utilisateur');
?>
    <section id="posts">
        <article class="post">
<?php

$_SESSION['currentUrl'] = $_SERVER['REQUEST_URI'];

$id = $_GET['id'];

echo showCompte($id);

// J'ai commencé à faire l'host des photos de profil mais jpp essayez vous mêmes
//echo uploadPfp();

echo showPosts($id);
