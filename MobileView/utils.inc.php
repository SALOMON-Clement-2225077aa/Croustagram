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
        <link rel="stylesheet" href="style.css">
        <title><?php echo 'Croustagram'; ?></title>
    </head>
    <body>
        <header>
            <img id="Logo" src="../ressources/logo.png">
            <div id="DivBarreRecherche">
                <button id="Recherche" onclick=""></button>
                <input id="BarreRecherche" type="text">
                <button id="EffacerRecherche" onclick=""></button>
            </div>
        </header>
    </body>
    <?php
}

?>