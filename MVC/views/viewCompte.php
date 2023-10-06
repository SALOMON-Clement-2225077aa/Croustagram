<head>
    <link rel="stylesheet" href="../public/assets/styles/computer/style.css">
</head>
<section id="posts">
    <article class="post">

<?php

require '../controllers/controllerCompte.php';
require '../controllers/CroustagramGUI.php';

Croustagram('Postes');

$id = $_GET['id'];

echo showCompte($id);

echo showPosts($id);
