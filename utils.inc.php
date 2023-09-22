<!-- Fonction start_page('titre') -->
<?php
    function start_page($title): void
    {

        ?><!DOCTYPE html>
        <html lang='fr'>
    <head>
        <meta charset="UTF-8">
        <meta name="titre" content="Page d'accueil">
        <meta name="description" content="Page principale sur laquelle l'utilisateur est censé tomber en premier">
        <title><?php echo $title; ?></title>
    </head>

    <body>
    <header>
        <h1>Croustagram</h1>
    </header>

    <nav id="leaderboard">
        <h2>Leaderboard :</h2>
    </nav>

    <section id="posts">
        <article class="post">
            <h2>aucun post</h2>
        </article>
    </section>

    <section id="pointCpt">
        <h2>Mes points crous : 0</h2>
    </section>

    <section id="liens">
        <form action="creationCompte/pageCreationCompte.php">
            <button>Rejoindre la croustagrammance</button>
        </form>
        <form action="connexionCompte/pageConnexionCompte.php">
            <button>Se connecter à un compte</button>
        </form>
    </section>


    <section id="ad">
        <h3>your ad here</h3>
    </section>

    </body>
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
    <html lang="fr">
            <?php
                echo '<br><br>';
                echo '<h2>Merci de votre visite !<br>Revenez bientôt</h2>';
            ?>
        </body>
<?php 
    }
?>
<!---------------------->