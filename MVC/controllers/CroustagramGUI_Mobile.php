<?php

function start_page($title) :void
{
    $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
    if(!$isMob){header("Location: ../views/viewMainPage.php");}
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="titre" content="Page d'accueil">
        <link rel="icon" href="../../MVC/public/assets/images/logo.png" />
        <meta name="description" content="Page d'accueil de Croustagram - Mobile">
        <link rel="stylesheet" href="../../MVC/public/assets/styles/mobile/styleMobile.css">
        <?php
        // Choix de la fiche de style
        if($title == 'Croustaccueil') {
            echo '<link rel="stylesheet" href="../../MVC/public/assets/styles/mobile/homePage.css">';
        }
        else if ($title == 'Leaderboard') {
            echo '<link rel="stylesheet" href="../../MVC/public/assets/styles/mobile/leaderBoard.css">';
        }
        else if ($title == 'Profil') {
            echo '<link rel="stylesheet" href="../../MVC/public/assets/styles/mobile/profil.css">';
        }
        else if ($title == 'Crousnexion') {
            echo '<link rel="stylesheet" href="../../MVC/public/assets/styles/mobile/connexionPage.css">';
        }
        else if ($title == 'Crouscription') {
            echo '<link rel="stylesheet" href="../../MVC/public/assets/styles/mobile/inscription.css">';
        }
        else if ($title == 'Créer un Croustapost') {
            echo '<link rel="stylesheet" href="../../MVC/public/assets/styles/mobile/creerPost.css">';
        }
        ?>
        <title><?php echo 'Croustagram - '.$title?></title>
    </head>
    <body>
    <header>
        <div id="DivLogoBarre">
            <img id="Logo" src="../../MVC/public/assets/images/logo.png">
            <div id="DivBarreRecherche">
                <button id="Recherche" onclick=""></button>
                <input id="BarreRecherche" type="text">
                <button id="EffacerRecherche" onclick=""></button>
                <button id="FiltrerRecherche" onclick=""></button>
            </div>
        </div>
        <h1 id="PageTitre"><?php echo $title ?></h1>
    </header>
    <?php
}

function end_page(): void
{
    ?>
        <footer>
            <button id="BoutonHome" onclick="window.location.href='../views/viewMainPage_Mobile.php';"></button>
            <button id="BoutonLeaderboard" onclick="window.location.href='../views/viewLeaderboard_Mobile.php';"></button>

            <?php if (isset($_SESSION['username'])) { ?>
                <button id="BoutonProfil" onclick="window.location.href='../views/viewProfil_Mobile.php';"></button>
            <?php }
            else { ?>
                <button id="BoutonProfil" onclick="window.location.href='../views/viewConnexionPage_Mobile.php';"></button>
            <?php } ?>
        </footer>
    <?php
}
?>