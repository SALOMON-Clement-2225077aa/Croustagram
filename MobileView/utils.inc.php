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
        <title>Croustagram</title>
    </head>
    <body>
        <header>
            <div id="DivLogoBarre">
                <img id="Logo" src="../../ressources/logo.png">
                <div id="DivBarreRecherche">
                    <button id="Recherche" onclick=""></button>
                    <input id="BarreRecherche" type="text">
                    <button id="EffacerRecherche" onclick=""></button>
                    <button id="FiltrerRecherche" onclick=""></button>
                </div>
            </div>
            <h1><?php echo $title ?></h1>
        </header>
    <?php
}

function end_page($title): void
{
    ?>
    <!DOCTYPE html>
    <html lang="fr">
        <footer>
            <button id="BoutonHome" onclick="window.location.href='../HomePage/index.php';"></button>
            <button id="BoutonLeaderboard" onclick="window.location.href='../LeaderboardPage/index.php';"></button>
            <button id="BoutonProfil" onclick="window.location.href='../ProfilPage/index.php';"></button>
        </footer>
    </body>
    <?php
}
?>