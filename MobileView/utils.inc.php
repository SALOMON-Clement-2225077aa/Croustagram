<?php

/*
 * Fonction start_page
 */

function start_page($title) :void
{
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="titre" content="Page d'accueil">
        <meta name="description" content="Page principale sur laquelle l'utilisateur est censé tomber en premier">
        <title><?php echo 'Croustagram'; ?></title>
    </head>
    <body>
        <header>
            <img src="../resources/logo.png">
        </header>
    </body>
    <?php
}

?>