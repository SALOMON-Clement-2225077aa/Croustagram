<?php
require '../controllers/controllerPoste.php';
require_once '../controllers/CroustagramGUI.php';
require '../controllers/controllerCommentaires.php';

$id = $_GET['id'];

echo Croustagram("Commentaires");
?>
<section id="posts">
    <article class="post">
        <?php

$_SESSION['currentUrl'] = $_SERVER['REQUEST_URI'];

echo showOnePost($id);

echo '<h2>Commentaires :</h2>';

if (isset($_SESSION['username'])){
    echo showinterfaceAjoutCommentaire();
}


echo showCommentaires($id);