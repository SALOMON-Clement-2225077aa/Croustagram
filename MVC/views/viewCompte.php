<?php

require '../controllers/controllerCompte.php';
require '../controllers/CroustagramGUI.php';

Croustagram('Postes');
?>
    <section id="posts">
        <article class="post">
<?php

$_SESSION['currentUrl'] = $_SERVER['REQUEST_URI'];

$id = $_GET['id'];

echo showCompte($id);

echo showPosts($id);
