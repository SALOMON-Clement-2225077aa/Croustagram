<!-- Fonction start_page('titre') -->
<?php
    $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
    if($isMob){header("Location: ../MobileView/HomePage/index.php");}
    else
    {
    session_start();
    function start_page($title): void
    {

        ?><!DOCTYPE html>
        <html lang='fr'>
    <head>
        <meta charset="UTF-8">
        <meta name="titre" content="Page d'accueil">
        <link rel="icon" href="/ressources/logo.png" />
        <meta name="description" content="Page d'accueil de Croustagram - Dekstop">
        <link rel="stylesheet" href="style.css">
        <title><?php echo $title; ?></title>
    </head>

    <body>
    <header>
        <img class="header" id="logo" src="/recources/1349px-Logo_Crous_vectorisé.svg.png">
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
            echo '<button onclick="ouvrirPost()" style="left:650px; top:50px; position:fixed"> Créer un croustapost </button>';
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
    </section>
<?php
    }
?>
<!--------------------------------->

<!-- Fonction end_page -->
<?php
    function end_page(): void
    {
?>
    <!DOCTYPE html>
    <html lang='fr'>
    <body>
    </body>
<?php
    }
?>
<!---------------------->



<!-- Afficher un post -->
<?php
    function afficher_post($croustagrameur, $titre, $message, $date, $categorie, $ptsCrous): void
    {
?>
<div id="post" style="margin-bottom: 25px">
    <table id="tabPost">
        <tr>
            <th><img src="../ressources/profil.png" id="imgProfil"> <?php echo $croustagrameur ?> </th>
            <th id="titrePost"><?php
                echo '<h1>' . $titre . '</h1>';
                ?></th>
            <th><?php
                echo $date;
            ?></th>
        </tr>
        <tr>
            <th colspan="3"><?php
                echo '<h2>' . $message . '</h2>';
                ?></th>
        </tr>
        <tr>
            <th> <?php echo $ptsCrous ?>
                <button onclick="upVote()"> <img src="../ressources/fleche-vers-le-haut.png" id="imgProfil"> </button>
                <button onclick="downVote()"> <img src="../ressources/fleche-vers-le-bas.png" id="imgProfil"> </button>
            </th>
            <th> <?php echo $categorie ?> </th>
            <th><img src="../ressources/commentaire.png" id="imgProfil"></th>
        </tr>
    </table>
</div>
<?php
}
}
?>
<!---------------------->