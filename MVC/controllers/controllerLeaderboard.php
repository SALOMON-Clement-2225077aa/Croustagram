<?php
require '../models/modelLeaderboard.php';


/**
 * Fonction qui permet l'affichage d'un utilisateur dans le leaderboard
 * @param $pseudo = le pseudo de l'user qu'on veut afficher dans le leaderboard
 * @param $ptsCrous = son nombre de pts crous
 * @param $img = sa photo de profil
 * @return void
 */
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

/**
 * Fonction qui permet l'affichage du leaderboard contenant tous les utilisateurs affichés
 * @return void
 */
function showLeaderboard(){

    // On récup les données du leaderboard,  on définit une limite
    $data = getLeaderboardData();
    $limite = 50;
    $cpt = 0;

    //$result->fetch(PDO::FETCH_ASSOC)
    while ($row = $data->fetch(PDO::FETCH_ASSOC)) {
        afficher_user($row['id'], $row['ptsCrous'], $row['img']);
        $cpt += 1;
        if($cpt>=$limite) {
            break;
        }
    }

    // On économise de la mémoire
    $data->closeCursor();
}
