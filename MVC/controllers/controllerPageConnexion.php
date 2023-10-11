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
            <?php if ($isMob) { ?>
            <form action="request.php" method="post">
                <?php }
                else { ?>
                <form action="../controllers/connectAccount.php" method="post" id="FormConnect">
                    <?php } ?>
                    <div class="FormDiv">
                        <label>Identifiant :</label>
                        <input type="text" name="username" required>
                    </div>
                    <div class="FormDiv">
                        <label>Mot de passe :</label>
                        <input type="password" name="password" required>
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
                    <?php } ?>
                </form>
                <h1 id="PasDeCompte">Pas de compte ?</h1>
                <?php if ($isMob) { ?>
                    <button id="InscriptionBouton" onclick="window.location.href='../CreationComptePage/index.php'">S'inscrire</button>
                <?php }
                else { ?>
                    <button id="InscriptionBouton" onclick="window.location.href='../views/viewCreerCompte.php'">S'inscrire</button>
                <?php } ?>
        </div>
    </div>
    </body>
    <?php
}