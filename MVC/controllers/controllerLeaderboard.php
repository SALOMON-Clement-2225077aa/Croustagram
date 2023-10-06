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

    while ($row = mysqli_fetch_assoc($data)) {
        afficher_user($row['pseudo'], $row['ptsCrous']);
    }

    mysqli_free_result($data);
}
