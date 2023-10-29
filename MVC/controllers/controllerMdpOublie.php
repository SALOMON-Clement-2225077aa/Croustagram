<?php

function mdpOublie() { ?>
    <div id="ContenuPage">
        <form id="FormMdpOublie" action="../controllers/sendMail.php" method="post">
            <label id="mdpOublieEmailLabel">Entrez votre adresse e-mail :</label>
            <input id="mdpOublieInput" type="email" name="mail">
            <button id="mdpOublieSendBouton">Recevoir un mail de réinitialisation du mot de passe</button>
        </form>
    </div>

<?php } ?>