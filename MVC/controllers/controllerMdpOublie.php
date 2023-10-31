<?php

/**
 * @return void
 * Fonction qui permet l'affichage du formulaire de mot de passe oublié
 */
function mdpOublie() { ?>
    <div id="ContenuPage">
        <form id="FormMdpOublie" action="../controllers/sendMail.php" method="post">
            <label id="mdpOublieEmailLabel">Entrez votre adresse e-mail :</label>
            <input id="mdpOublieInput" type="email" name="mail">
            <button id="mdpOublieSendBouton">Recevoir un mail de réinitialisation du mot de passe</button>
        </form>
    </div>

<?php } ?>