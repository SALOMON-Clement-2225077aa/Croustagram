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
                <img id="Logo" src="../../ressources/logo.png">
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
    <!DOCTYPE html>
    <html lang="fr">
        <footer>
            <button id="BoutonHome" onclick="window.location.href='../HomePage/index.php';"></button>
            <button id="BoutonLeaderboard" onclick="window.location.href='../LeaderboardPage/index.php';"></button>
            <button id="BoutonProfil" onclick="window.location.href='../ConnexionPage/index.php';"></button>
        </footer>
    </body>
    <?php
}
?>

<!-- Afficher un post --> 
<?php
    function afficher_post($croustagrameur, $titre, $message, $date, $categorie1, $categorie2, $categorie3, $ptsCrous, $idPost): void
    {
?>
<br><br><br><br>
<div id="post">
    <table id="tabPost">
        <tr>
            <th><img src="../../ressources/profil.png" id="imgProfil"> <?php echo $croustagrameur ?> </th>
            <th id="titrePost"><?php
                echo '<h1>' . $titre . '</h1>';
                ?></th>
            <th><?php
                echo $date;
            ?></th>
        </tr>
        <tr>
            <th colspan="3">
                <h2> <?php echo wordwrap($message, 30, '<br>', true) ?> </h2>
                </th>
        </tr>
        <tr>
            <th> <?php echo $ptsCrous ?>
                <button onclick="upVote()" id="UpVoteBouton">
                <button onclick="downVote()" id="DownVoteBouton">
            </th>
            <th> <?php echo $categorie1 . ', ' ; echo $categorie2 . ', ' ; echo $categorie3 ?> </th>
            <th><button id="CommentaireBouton"></th>
        </tr>
    </table>
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