<?php
require '../models/modelLeaderboard.php';

function afficher_user($pseudo, $ptsCrous, $img) {?>
    <a href="../views/viewCompte.php?id=<?php echo $pseudo ?>" style="text-decoration: none; color: black">
        <div class="User">
            <?php
            if($img == 'no_img') {
                echo '<img draggable="false" alt="Photo de profil" onclick="window.location.href = \'viewCompte.php?id=' . $pseudo . '\';" src="../public/assets/images/profil.png" class="imgProfil" >';
            }
            else {
                echo '<img draggable="false" alt="Photo de profil" onclick="window.location.href = \'viewCompte.php?id=' . $pseudo . '\';" src="'. $img .'" class="imgProfil" >';
            }
            ?>
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
        afficher_user($row['id'], $row['ptsCrous'], $row['img']);
    }

    $data->closeCursor();
}
