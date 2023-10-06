<head>
    <link rel="stylesheet" href="../public/assets/styles/computer/style.css">
</head>
<section id="posts">
    <article class="post">

<?php

require '../controllers/controllerPoste.php';
require '../controllers/CroustagramGUI.php';
require '../controllers/controllerCommentaires.php';

$id = $_GET['id'];

echo Croustagram("Commentaires");

echo showOnePost($id);

echo '<h2>Commentaires :</h2>';

echo showCommentaires($id);