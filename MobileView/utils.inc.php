<?php

/*
 * Fonction start_page
 */

function start_page($title) :void
{
    $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
    if(!$isMob){header("Location: ../../ComputerView/index.php");}
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="titre" content="Page d'accueil">
        <link rel="icon" href="/ressources/logo.png" />
        <meta name="description" content="Page d'accueil de Croustagram - Mobile">
        <link rel="stylesheet" href="style.css">
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

function end_page($title): void
{
    ?>
        <footer>
            <button id="BoutonHome" onclick="window.location.href='../HomePage/index.php';"></button>
            <button id="BoutonLeaderboard" onclick="window.location.href='../LeaderboardPage/index.php';"></button>

            <?php if (isset($_SESSION['username'])) { ?>
                <button id="BoutonProfil" onclick="window.location.href='../ProfilPage/index.php';"></button>
            <?php }
            else { ?>
                <button id="BoutonProfil" onclick="window.location.href='../ConnexionPage/index.php';"></button>
            <?php } ?>
        </footer>
    </body>
    <?php
}
?>

    <!-- Afficher un post -->
    <?php
        require '../../managePost/recupCategorie.php';
        function afficher_post($croustagrameur, $titre, $message, $date, $categorie1, $categorie2, $categorie3, $ptsCrous, $idPost, $nb_comm): void
        {
    ?>
        <br><br>
        <div id="post">
            <div id="userEtDate">
                <div id="userPost">
                    <img src="../../ressources/profil.png" id="imgProfil">
                    <label> <?php echo $croustagrameur; ?> </label>
                </div>
                <label id="datePost"> <?php echo $date; ?> </label>
            </div>

            <h1 id="TitrePost"> <?php echo wordwrap($titre, 35, '<br>', true); ?> </h1>

            <h2 id="ContenuPost"> <?php echo wordwrap($message, 35, '<br>', true) ?> </h2>

            <?php $les_categories = convert_cat($categorie1, $categorie2, $categorie3) ?>

            <label id="Categories"> <?php echo wordwrap($les_categories, 35, '<br>', true) ?> </label>

            <div id="BasPost">
                <label id="pointsPost"> <?php echo $ptsCrous ?> </label>
                <div id="Votes">
                    <button onclick="upVote()" id="UpVoteBouton">
                    <button onclick="downVote()" id="DownVoteBouton">
                </div>
                <th> <?php echo $nb_comm; ?></th> <button id="CommentaireBouton"></button>
            </div>
        </>
    </div>
    <?php
    }
    ?>
    <!---------------------->


    <!-- Afficher un user -->
    <?php
    function afficher_user($pseudo, $img, $date_creation, $date_connexion, $ptsCrous) {?>
        <div id="User">
            <img src="../../ressources/profil.png" id="imgProfil">
            <div>
                <th><?php echo $pseudo ?></th>
                <th><br><?php echo $ptsCrous ?></th>
            </div>
        </div>
    <?php
    }
    ?>
    <!---------------------->
</html>