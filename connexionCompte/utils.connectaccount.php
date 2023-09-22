<?php
    function connexion_page()
    {
        ?>
        <!DOCTYPE html>
        <html lang='fr'>
        <head>
            <meta charset="UTF-8">
            <meta name="titre" content="Se connecter à un compte">
            <meta name="description" content="Page pour se connecter à un compte">
            <title>Crousnexion</title>
        </head>
    <body>
    <h1>Se crousnecter à son crous-compte (là j'avoue j'ai pas de jeu de mots)</h1>
    </body>

    <form action="connectAccount.php" method="post">
        <label>Nom d'utilisateur :</label><br><br>
        <input type="text" name="username"><br><br>
        <label>Mot de passe :</label><br><br>
        <input type="password" name="password"><br><br>
        <button type="submit">Se crousnecter</button>
    </form>


    <?php
    }