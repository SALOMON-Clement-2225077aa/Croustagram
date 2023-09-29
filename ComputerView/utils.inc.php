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
        <link rel="icon" href="../ressources/logo.png" />
        <meta name="description" content="Page d'accueil de Croustagram - Dekstop">
        <link rel="stylesheet" href="style.css">
        <title><?php echo $title; ?></title>
    </head>

    <body>
    <header>
        <div id="divLogo">
            <img class="header" id="logo" src="../ressources/logo.png">
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
        <?php // Lecture + Affichage des utilisateurs de la BD (SELECT * FROM `croustagrameur`)

        // Connexion à la base de donnée
        $dbLink = mysqli_connect("mysql-croustagramadd.alwaysdata.net", 328031, "b1Gz0000")
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
        mysqli_select_db($dbLink , "croustagramadd_bdd")
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

        // Requête
        $result = mysqli_query($dbLink, 'SELECT * FROM croustagrameur ORDER BY ptsCrous DESC');

        // Si la requête a marché on affiche les users
        if ($result) {
            // afficher_user($pseudo, $img, $date_creation, $date_connexion, $ptsCrous):
            while ($row = mysqli_fetch_assoc($result)) {
                afficher_user($row['pseudo'], $row['img'], $row['creation_compte'], $row['derniere_connexion'], $row['ptsCrous']);
            }
            // Libère la variable
            mysqli_free_result($result);
        }
        else {
            echo 'Erreur dans la requête : ' . mysqli_error($dbLink);
        }
        ?>
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
    function afficher_post($croustagrameur, $titre, $message, $date, $categorie1, $categorie2, $categorie3, $ptsCrous, $idPost): void
    {
?>
<form action="../managePost/pagePost.php" >
<div id="post" style="margin-bottom: 25px">
    <table id="tabPost">
        <tr>
            <th><img src="../ressources/profil.png" id="imgProfil" ></th>
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
            <th> <?php echo $categorie1 . ', ' ; echo $categorie2 . ', ' ; echo $categorie3 ?> </th>
            <th>
                <a href="../managePost/pagePost.php?id=<?php echo $idPost?>">
                    <img src="../ressources/commentaire.png" id="imgProfil">
                </a>
            </th>
        </tr>
    </table>
</div>
</form>
<?php
}
}
?>
<!---------------------->

<!-- Afficher un user -->
<?php
function afficher_user($pseudo, $img, $date_creation, $date_connexion, $ptsCrous) {?>
    <div id="User">
        <img src="../ressources/profil.png" id="imgProfil">
        <div>
            <th><?php echo $pseudo ?></th>
            <th><br><?php echo $ptsCrous ?></th>
        </div>
    </div>
    <?php
}
?>
<!---------------------->
