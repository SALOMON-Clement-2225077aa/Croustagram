<?php

require 'creationCompte/utils.createaccount.php';

?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="titre" content="Page d'accueil">
        <link rel="icon" href="/ressources/logo.png" />
        <meta name="description" content="Page d'accueil de Croustagram - Mobile">
        <link rel="stylesheet" href="style.css">
        <title>Croustagram</title>
    </head>
    <body>
        <div id="BoxMilieu">
            <?php
            account_page();
            ?>
        </div>
    </body>
<?php

?>