<?php
    require_once 'controllerLeaderboard.php';
    require_once 'controllerPointsCrous.php';
    require_once 'controllerMenuCategorie.php';
function Croustagram($titre, $showCompteStats = true, $showCreatePost = true): void
{
    $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
    if($isMob){header("Location: ../views/viewMainPage_Mobile.php");}
    $titre = 'Croustagram - ' . $titre;
    session_start();
?>
<!DOCTYPE html>
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
            <img alt="Logo du site" class="header" id="logo" src="../public/assets/images/logo.png">
            <h1 class="header" id="titre"><?php echo $titre ?></h1>
        </div>
    </a>

    <!-- Barre de recherche -->
    <div class="header" id="DivLogoBarre">
        <div id="DivBarreRecherche">
            <form action="" method="post" >
                <button id="Recherche" type="submit"></button>
                <input id="BarreRecherche" type="text" name="recherche">
                <button id="EffacerRecherche" type="reset" onclick="window.location.href = '../views/viewMainPage.php';"></button>
                <button id="TrierRecherche" name="tri" onclick="window.location.href = '../views/viewMainPage.php'"></button>
            </form>
            <!-- filtre par catégorie : -->
            <form action="../views/viewMainPage.php" method="post">
                <select id="FiltrerRecherche" hidden="until-found" name='categorie' onchange="this.form.submit()" >
                    <option value="">-- Filtrer la catégorie --</option>
                    <option value="0">Aucune</option>
                    <?php selectCategorie(); ?>
                </select>
            </form>
        </div>
    </div>

        <?php
        if(isset($_SESSION['suid']))
        {
            if($showCreatePost) {
                echo '<button onclick="window.location.href = \'../views/viewCreerPost.php\';" id="créerPost"> Créer un croustapost </button>';
            }
            echo '<a style="color : black" href="../views/viewCompte.php?id=' . $_SESSION['username'] . '"><label style="cursor: pointer; top: 20px; right: 20px; position: fixed">Connecté en tant que : ' . $_SESSION['username'] . '</label></a>';
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

    <section id="ad">
        <h3>your ad here</h3>
    </section>
</div>
    </body>
<?php
    }
}
