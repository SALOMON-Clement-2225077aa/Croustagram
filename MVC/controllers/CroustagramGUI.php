<?php
    require 'controllerLeaderboard.php';
    require 'controllerPointsCrous.php';
function Croustagram($titre, $showCompteStats = true, $showCreatePost = true): void
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
<header style="z-index: 1000">
    <a href="../views/viewMainPage.php" style="text-decoration: none">
        <div id="divLogo">
            <img class="header" id="logo" src="../public/assets/images/logo.png">
            <h1 class="header" id="titre"><?php echo $titre ?></h1>
        </div>
    </a>
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
            if($showCreatePost) {
                echo '<button onclick="window.location.href = \'../views/viewCreerPost.php\';" id="créerPost"> Créer un croustapost </button>';
            }
            echo '<label style="top: 20px; right: 20px; position: fixed">Connecté en tant que : ' . $_SESSION['username'] . '</label>';
            echo '<button onclick="window.location.href = \'../controllers/logout.php\';" style="right: 10px; top: 50px; position: fixed"> Se déconnecter </button>';
        }
        else
        {
            echo '<button onclick="window.location.href = \'../views/viewConnexionPage.php\';" style="right: 20px; top:50px; position: fixed"> Se connecter à un compte/s\'inscrire</button>';
        }
        ?>
</header>

<section style="z-index: 1000" id="leaderboard">
    <h2>Leaderboard :</h2>
    <?php
        showLeaderboard();
    ?>
</section>

<?php

if($showCompteStats){

?>
<div>
    <section id="pointCpt">
    <?php
    if (isset($_SESSION['username'])) {
        ?>
        <h2 style="font-size: 40px;">Mes points crous :<br>
            <?php
                echo showPtsCrous();
            ?>
        </h2>
    <?php
    }
    else{
        ?>
        <h2 style="font-size: 30px;">Vous devez vous connecter à un compte pour accéder aux fonctionalités du site !<br>
        </h2>
        <?php
    }
    ?>
    </section>

    <section id="ad">
        <h3>your ad here</h3>
    </section>
</div>
<?php
    }
}