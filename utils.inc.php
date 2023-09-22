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
        <link rel="stylesheet" href="style.css">
        <title><?php echo $title; ?></title>
    </head>

    <body>
    <header>
        <img class="header" id="logo" src="/recources/1349px-Logo_Crous_vectorisé.svg.png">
        <h1 class="header">Croustagram</h1>
        <button> Créer un croustapost </button>
        <button onclick="window.location.href = 'creationCompte/pageCreationCompte.php';" style="margin-left: 10px"> Rejoindre la croustagrammance </button>
        <button onclick="window.location.href = 'connexionCompte/pageConnexionCompte.php';" style="margin-left: 10px"> Se connecter à un compte </button>
    </header>

    <section id="leaderboard">
        <h2>Leaderboard :</h2>
    </section>

    <div id="body">
        <section id="posts">
            <article class="post">
                <h2>aucun post</h2>
            </article>
        </section>

    <section id="pointCpt">
        <h2>Mes points crous : 0</h2>
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
    <html lang='fr'>
    <body>
    </body>
<?php 
    }
?>
<!---------------------->
