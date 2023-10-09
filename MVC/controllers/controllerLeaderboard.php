<?php
require '../models/modelLeaderboard.php';

function afficher_user($pseudo, $ptsCrous) {?>
    <div id="User">
        <img src="../public/assets/images/profil.png" id="imgProfil">
        <div>
            <th><?php echo $pseudo ?></th>
            <th><br><?php echo $ptsCrous ?></th>
        </div>
    </div>
    <?php
}

function showLeaderboard(){

    $data = getLeaderboardData();

    //$result->fetch(PDO::FETCH_ASSOC)
    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        afficher_user($row['pseudo'], $row['ptsCrous']);
    }

    $data->closeCursor();
}
