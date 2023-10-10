<?php
require '../models/modelLeaderboard.php';

function afficher_user($pseudo, $ptsCrous) {?>
    <a href="../views/viewCompte.php?id=<?php echo $pseudo ?>" style="text-decoration: none; color: black">
        <div id="User">
            <img src="../public/assets/images/profil.png" id="imgProfil">
            <div>
                <th><?php echo $pseudo ?></th>
                <th><br><?php echo $ptsCrous ?></th>
            </div>
        </div>
    </a>
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
