<head>
    <link rel="stylesheet" href="../../ComputerView/style.css">
</head>
<section id="posts">
    <article class="post">

<?php
require 'controllerCompte.php';
echo showPosts($_GET['id']);
