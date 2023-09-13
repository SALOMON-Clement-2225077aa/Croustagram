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
        <h1>Hello World !</h1>
        <h1>Ceci est la première version de Croustagram !</h1>
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