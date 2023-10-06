<?php
    function connexion_page($tabErreurs = array())
    {
        $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
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
            <?php if(in_array('bocchi', $tabErreurs)) echo'<audio src="https://dl8.wapkizfile.info/download/8917797c3a9c7bc00f84cbda67594f42/6dd81d31e4d757652506da1cb7b49599/osanime+wapkiz+com/Seishun-Complex-(osanime.com).mp3" autoplay></audio>'   ?>
            <div id="ContenuPage">
                <div id="BoxMilieu">
                    <?php if ($isMob) { ?>
                        <form action="request.php" method="post">
                    <?php }
                    else { ?>
                        <form action="connectAccount.php" method="post">
                    <?php } ?>
                        <div class="FormDiv">
                            <label>Identifiant :</label>
                            <input type="text" name="username" required>
                        </div>
                        <div class="FormDiv">
                            <label>Mot de passe :</label>
                            <input type="password" name="password" required>
                        </div>
                        <button id="FormBouton" type="submit">Se connecter</button>
                        <?php
                        if (in_array('noMatchFoundUsername', $tabErreurs))
                        { ?>
                           <label id="erreurLabel"><strong>Le couple adresse e-mail / mot de passe ne correspond à aucun compte !</strong></label>
                        <?php }
                        elseif (in_array('noMatchFoundMail', $tabErreurs))
                        { ?>
                            <label id="erreurLabel"><strong>Le couple adresse e-mail / mot de passe ne correspond à aucun compte !</strong></label>
                        <?php } ?>
                    </form>
                    <h1 id="PasDeCompte">Pas de compte ?</h1>
                    <button id="InscriptionBouton" onclick="window.location.href='../creationCompte/pageCreationCompte.php'">S'inscrire</button>
                </div>
            </div>
        </body>
    <?php
    }