<?php

function resetMdp() { ?>
    <div id="ContenuPage">
        <form id="FormMdpOublie" action="../models/changeMdp.php" method="post">
            <label class="resetLabel">Entrez votre mot de passe :</label>
            <input class="resetInput" name="mdp" type="password"  placeholder="Mot de passe">
            <label class="resetLabel">Vérifiez votre mot de passe :</label>
            <input class="resetInput" name="verifMdp" type="password"  placeholder="Vérifier le mot de passe">
            <button id="mdpOublieSendBouton" type="submit" name="accountName" value="' . $_GET['accountId'] . '">Changer le mot de passe</button>
        </form>
    </div>
<?php } ?>