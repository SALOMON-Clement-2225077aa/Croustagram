<?php
    require_once 'controllerLeaderboard.php';
    require_once 'controllerPointsCrous.php';
    require_once 'controllerMenuCategorie.php';
    require_once '../models/modelAdmin.php';
    require_once '../models/modelCompte.php';

/**
 * Fonction qui génère la 'general user interface' pour PC :
 * Elle permet donc l'affichage du header, du leaderboard, des points crous de l'utilisateur
 * (si il est connecté) et de la boîte dédiée à une potentielle publicité.
 * @param $titre = le titre de la page
 * @param $showCompteStats = les stats de notre compte
 * @param $showCreatePost = la création d'un post
 * @return void
 */
function Croustagram($titre, $showCompteStats = true, $showCreatePost = true): void
{
    // On vérifie qu'on soit pas sur tel
    $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
    if($isMob){header("Location: ../views/viewMainPage_Mobile.php");}

    // On met en place le titre de croustagram
    $titre = 'Croustagram - ' . $titre;
    session_start();

    // On update notre position actuelle dans le site
    $_SESSION['currentUrl'] = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang='fr'>
<head>
    <meta name="google-site-verification" content="_pnlU29nynGkGXBLZpOj2xSqbPqGWmXyJyXiCjy2-9s" />
    <meta charset="UTF-8">
    <meta name="titre" content="Page d'accueil">
    <link rel="icon" href="../public/assets/images/logo.png" />
    <meta name="description" content="Page d'accueil de Croustagram - Dekstop">
    <link rel="stylesheet" href="../public/assets/styles/computer/barre_de_recherche.css">
    <link rel="stylesheet" href="../public/assets/styles/computer/style.css">
    <title><?php echo $titre; ?></title>
</head>

<header style="z-index: 1000">
    <a href="../views/viewMainPage.php" style="text-decoration: none">
        <div id="divLogo">
            <img alt="Logo du site" class="header" id="logo" src="../public/assets/images/logo.png">
            <h1 class="header" id="titre"><?php echo $titre ?></h1>
        </div>
    </a>

    <!-- Barre de recherche -->
    <div class="header" id="DivLogoBarre">
        <div id="DivBarreRecherche">
            <form method="post" >
                <button id="Recherche" type="submit"></button>
                <?php
                if(isset($_POST['recherche'])) {
                    echo '<input id="BarreRecherche" type="text" name="recherche" value="' .$_POST['recherche'] . '">';
                }
                else{
                    echo '<input id="BarreRecherche" type="text" name="recherche">';
                }
                ?>
                <button id="EffacerRecherche" type="reset" onclick="window.location.href = '../views/viewMainPage.php';"></button>
                <button id="TrierRecherche" name="tri" onclick="window.location.href = '../views/viewMainPage.php'"></button>
            </form>
            <!-- filtre par catégorie : -->
            <form action="../views/viewMainPage.php" method="post">
                <select id="FiltrerRecherche" name='categorie' onchange="this.form.submit()">
                    <option value=""> </option>
                    <option value="0">Aucune</option>
                    <?php selectCategorie(); ?>
                </select>
            </form>
        </div>
    </div>

        <?php
        if(isset($_SESSION['username']))
        {
            if($showCreatePost) {
                echo '<button onclick="window.location.href = \'../views/viewCreerPost.php\';" id="créerPost"> Créer un croustapost </button>';
                if (isAdmin($_SESSION['username'])) {
                    echo '<button onclick="window.location.href = \'../views/viewCreerCategorie.php\';" id="créerPost"> Créer une croustégorie </button>';
                }
            }

            // Affiche l'utilisateur connecté (phot, pseudo, bouton déconnexion)
            echo '<button onclick="window.location.href = \'../controllers/logout.php\';" style="right: 100px; top: 50px; position: fixed"> Se déconnecter </button>';
            echo '<a style="color : black" href="../views/viewCompte.php?id=' . $_SESSION['username'] . '">';
                echo '<label style="cursor: pointer; top: 20px; right: 100px; position: fixed">' . $_SESSION['username'] . '</label>';
                echo '<img draggable="false" alt="Photo de profil" src=' . getImgCompte($_SESSION['username']) . ' class="imgSession">';
            echo '</a>';

        }
        else
        {
            echo '<button onclick="window.location.href = \'../views/viewConnexionPage.php\';" style="right: 20px; top:50px; position: fixed"> Se connecter à un compte/s\'inscrire</button>';
        }
        ?>

</header>

<body>
<section style="z-index: 1000" id="leaderboard">
    <h2>Classement : </h2>
    <?php
        if(isset($_SESSION['username'])) {
            echo '<h2>Mon classement : ' . myPosition() . '</h2>';
        }
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
        <h2 style=" color: white; font-size: 40px;">Mes points Crous :<br>
            <?php
                echo showPtsCrous();
            ?>
        </h2>
    <?php
    }
    else{
        ?>
        <h2 style="color: white; font-size: 30px;">Vous devez vous connecter à un compte pour accéder aux fonctionalités du site !<br>
        </h2>
        <?php
    }
    ?>
    </section>

    <section c>
        <?php
            if (isset($_SESSION['username'])) {
                if (isAdmin($_SESSION['username'])) {
                    echo '<h3>Compte Administrateur</h3>';
                }
            }
            else {
                echo '<h3>your ad here</h3>';
            }
        ?>
    </section>
</div>
<?php
    }
}
?>


