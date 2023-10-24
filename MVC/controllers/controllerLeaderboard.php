<?php
require '../models/modelLeaderboard.php';

function afficher_user($pseudo, $ptsCrous) {?>
    <a href="../views/viewCompte.php?id=<?php echo $pseudo ?>" style="text-decoration: none; color: black">
        <div class="User">
            <img alt="Photo de profil de l'utilisateur" src="../public/assets/images/profil.png" class="imgProfil">
            <div>
                <?php echo $pseudo ?>
                <br><?php echo $ptsCrous ?>
            </div>
        </div>
    </a>
    <?php
}

function showLeaderboard(){

    $data = getLeaderboardData();

    //$result->fetch(PDO::FETCH_ASSOC)
    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        afficher_user($row['id'], $row['ptsCrous']);
    }

    $data->closeCursor();
}
