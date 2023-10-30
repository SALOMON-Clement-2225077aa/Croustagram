<?php
function connexion_page($tabErreurs = array())
{
    if($tabErreurs === null) $tabErreurs = array();
    $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
    ?>
    <body <?php if(in_array('bocchi', $tabErreurs)) echo'style="background-image: url(\'https://media.tenor.com/-FrcCsUig4sAAAAC/spin-bocchi.gif\')"'?>>
    <?php if(in_array('bocchi', $tabErreurs)) echo'<audio src="https://www.myinstants.com/media/sounds/free-bird-solo.mp3" autoplay loop></audio>'   ?>
    <div id="ContenuPage">
        <div id="BoxMilieu">
            <form action="../controllers/connectAccount.php" method="post" id="FormConnect">
                <div class="FormDiv">
                    <label>Identifiant :</label>
                    <input type="text" name="username" required placeholder="Nom d'utilisateur">
                </div>
                <div class="FormDiv">
                    <label>Mot de passe :</label>
                    <input type="password" name="password" required placeholder="Mot de passe">
                </div>
                <br>
                <button id="FormBouton" type="submit">Se connecter</button>
                <?php
                if (in_array('noMatchFoundUsername', $tabErreurs))
                { ?>
                        <br>
                    <label id="erreurLabel">Le couple adresse e-mail / mot de passe ne </br>correspond à aucun compte !</label>
                <?php }
                elseif (in_array('noMatchFoundMail', $tabErreurs))
                { ?>
                    <label id="erreurLabel">Le couple adresse e-mail / mot de passe ne </br>correspond à aucun compte !</label>
                <?php }
                ?>
            </form>
            <br>
            <?php if ($isMob) { ?>
                <button id="FormBouton" type="button" style="font-size: 20px; color: red" onclick="window.location.href='../views/viewMdpOublie_Mobile.php'">Mot de passe oublié</button>
            <?php }
            else { ?>
                <button id="FormBouton" type="button" style="font-size: 20px; color: red" onclick="window.location.href='../views/viewMdpOublie.php'">Mot de passe oublié</button>
            <?php } ?>
            <h1 id="PasDeCompte">Pas de compte ?</h1>
            <?php if ($isMob) { ?>
                <button id="InscriptionBouton" onclick="window.location.href='../views/viewCreerCompte_Mobile.php'">S'inscrire</button>
            <?php }
            else { ?>
                <button id="InscriptionBouton" onclick="window.location.href='../views/viewCreerCompte.php'">S'inscrire</button>
            <?php } ?>
        </div>
    </div>
    </body>
    <?php
}