<?php
require_once 'controllerMenuCategorie.php';

function start_page($title) :void
{
    $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
    if(!$isMob){header("Location: ../views/viewMainPage.php");}
    session_start();
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
        else if ($title == 'Classement par PointCrous !') {
            echo '<link rel="stylesheet" href="../../MVC/public/assets/styles/mobile/leaderBoard.css">';
        }
        else if ($title == 'Mon profil') {
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
        else if ($title == 'Croustapost') {
            echo '<link rel="stylesheet" href="../../MVC/public/assets/styles/mobile/commentairePage.css">';
        }
        ?>
        <title><?php echo 'Croustagram - '.$title?></title>
    </head>
    <body>
    <header>

        <!-- Barre de recherche -->
        <div id="DivLogoBarre">
                <img id="Logo" src="../../MVC/public/assets/images/logo.png">
                <div id="DivBarreRecherche">
                    <!-- filtre par recherche (mot) ou trier par points : -->
                    <form id="DivLogoBarre" action="../views/viewMainPage_Mobile.php" method="post" >
                        <button id="Recherche" type="submit"></button>
                        <?php
                        if(isset($_POST['recherche'])) {
                            echo '<input id="BarreRecherche" type="text" name="recherche" value="' .$_POST['recherche'] . '">';
                        }
                        else{
                            echo '<input id="BarreRecherche" type="text" name="recherche">';
                        }
                        ?>
                        <button id="EffacerRecherche" type="reset" onclick="window.location.href = '../views/viewMainPage_Mobile.php'"></button>
                        <button id="TrierRecherche" name="tri" onclick="window.location.href = '../views/viewMainPage_Mobile.php'"></button>
                    </form>
                    <!-- filtre par catégorie : -->
                    <form action="../views/viewMainPage_Mobile.php" method="post">
                        <select id="FiltrerRecherche" hidden="until-found" name='categorie' onchange="this.form.submit()" >
                            <option value="">-- Filtrer la catégorie --</option>
                            <option value="0">Aucune</option>
                            <?php selectCategorie(); ?>
                        </select>
                    </form>
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
    </body>
    <?php
}
?>