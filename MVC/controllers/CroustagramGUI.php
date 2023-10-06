<?php

    require 'controllerLeaderboard.php';
function Croustagram($titre): void
{
    $titre = 'Croustagram - ' . $titre;
    session_start();
?><!DOCTYPE html>
<html lang='fr'>
<head>
    <meta charset="UTF-8">
    <meta name="titre" content="Page d'accueil">
    <link rel="icon" href="../public/assets/images/logo.png" />
    <meta name="description" content="Page d'accueil de Croustagram - Dekstop">
    <link rel="stylesheet" href="../public/assets/styles/computer/barre_de_recherche.css">
    <link rel="stylesheet" href="../public/assets/styles/computer/style.css">
    <title><?php echo $titre; ?></title>
</head>

<body>
<header>
    <div id="divLogo">
        <img class="header" id="logo" src="../public/assets/images/logo.png">
        <h1 class="header">Croustagram</h1>
    </div>
    <div class="header" id="DivLogoBarre">
        <div id="DivBarreRecherche">
            <button id="Recherche" onclick=""></button>
            <input id="BarreRecherche" type="text">
            <button id="EffacerRecherche" onclick=""></button>
            <button id="FiltrerRecherche" onclick=""></button>
        </div>
        <?php
        if(isset($_SESSION['suid']))
        {
            echo '<button onclick="ouvrirPost()" style="left:850px; top:50px; position:fixed"> Créer un croustapost </button>';
            echo '<label style="top: 40px; right: 20px; position: fixed">Connecté en tant que : ' . $_SESSION['username'] . '</label>';
            echo '<button onclick="window.location.href = \'logout.php\';" style="right: 10px; top: 60px; position: fixed"> Se déconnecter </button>';
        }
        else
        {
            echo '<button onclick="window.location.href = \'../connexionCompte/pageConnexionCompte.php\';" style="right: 20px; top:50px; position: fixed"> Se connecter à un compte/s\'inscrire</button>';
        }
        ?>
</header>

<section id="leaderboard">
    <h2>Leaderboard :</h2>
    <?php
        showLeaderboard();
    ?>
</section>
<?php
}