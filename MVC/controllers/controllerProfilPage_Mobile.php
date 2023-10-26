<?php

function contenuProfil() { ?>
    <div id="contenuPage">
        <div id="contenuProfil">
            <img id="photoDeProfil" src="../public/assets/images/profil.png">
            <label id="affichePseudoLabel"><?php echo 'Cafard crous' ?></label>

            <button id="boutonDeconnexion" onclick="window.location.href = '../controllers/logout.php'"> Se déconnecter </button>
        </div>
    </div>
<?php } ?>