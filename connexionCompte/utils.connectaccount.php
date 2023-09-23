<?php
    function connexion_page($tabErreurs = array())
    {
        ?>
        <!DOCTYPE html>
        <html lang='fr'>
        <head>
            <meta charset="UTF-8">
            <meta name="titre" content="Se connecter à un compte">
            <meta name="description" content="Page pour se connecter à un compte">
            <link rel="icon" href="/ressources/logo.png" />
            <title>Crousnexion</title>
        </head>
    <body <?php if(in_array('bocchi', $tabErreurs)) echo'style="background-image: url(\'https://media.tenor.com/-FrcCsUig4sAAAAC/spin-bocchi.gif\')"'?>>
    <h1>Se crousnecter à son crous-compte (là j'avoue j'ai pas de jeu de mots)</h1>

    <form action="connectAccount.php" method="post">
        <label>Nom d'utilisateur ou adresse mail :</label><br><br>
        <input type="text" name="username" required><br><br>
        <label>Mot de passe :</label><br><br>
        <input type="password" name="password" required><br><br>
        <button type="submit">Se crousnecter</button><br><br>
        <?php
        if (in_array('noMatchFoundUsername', $tabErreurs))
        {
            echo '<strong style=\'color:red;\'>Le couple nom d\'utilisateur et mdp ne correspond à aucun compte</strong>';
        }
        elseif (in_array('noMatchFoundMail', $tabErreurs))
        {
            echo '<strong style=\'color:red;\'>Le couple adresse email et mdp ne correspond à aucun compte</strong>';
        }
        ?>
    </form>
    </body>
    <?php
    }