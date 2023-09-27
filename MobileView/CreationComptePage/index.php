<?php

require 'creationCompte/utils.createaccount.php';
require 'MobileView/utils.inc.php';

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
    <?php start_page('Nouveau compte'); ?>
            <?php
            account_page();
            ?>
    <?php end_page('Nouveau compte'); ?>
<?php

?>