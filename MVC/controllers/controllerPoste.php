<?php
require_once 'controllerCompte.php';
require_once '../models/modelCompte.php';
require_once 'controllerCategorie.php';
require_once '../models/modelVote.php';

function showPost($croustagrameurId, $pseudo, $titre, $message, $date, $categorie1, $categorie2, $categorie3, $ptsCrous, $idPost, $nb_comm): void
{
    ?>
    <div class="post" style="margin-bottom: 25px">

            <div class="hautPostDiv">
                <div class="postUserDiv">
                    <img alt="Photo de profil" <?php echo 'onclick="window.location.href = \'viewCompte.php?id=' . $croustagrameurId . '\';"' ?> src="../public/assets/images/profil.png" class="imgProfil" >
                    <label id="nomUserPost"> <?php echo $pseudo ?> </label>
                </div>
                <label> <?php echo $date ?> </label>
            </div>

            <h1 class="titrePost"> <?php echo $titre ?> </h1>

            <h2 class="messagePost"> <?php echo wordwrap($message, 50, '<br>', true) ?> </h2>

            <?php $les_categories = convert_cat($categorie1, $categorie2, $categorie3) ?>
            <label class="categoriesPost"> <?php echo $les_categories ?> </label>

            <div class="basPostDiv">
                <div class="votesPostDiv">
                    <label class="pointCrousLabelPost"> <?php echo $ptsCrous ?> </label>
                    <!-- Boutons Up et Down vote -->
                    <?php
                        if(isset($_SESSION['username'])) {
                            $boolUp = dejaVote($_SESSION['username'],$idPost,1,0);
                            $boolDown = dejaVote($_SESSION['username'],$idPost,0,1);
                            if($boolUp == 1) {
                                echo '<button id="UpVoteBoutonPressed" onclick="window.location.href = \'../controllers/upVote.php?id=' . $idPost . '\'"></button>';
                                echo '<button id="DownVoteBouton" onclick="window.location.href = \'../controllers/downVote.php?id=' . $idPost . '\'"></button>';
                            }
                            else if($boolDown == 1) {
                                echo '<button id="UpVoteBouton" onclick="window.location.href = \'../controllers/upVote.php?id=' . $idPost . '\'"></button>';
                                echo '<button id="DownVoteBoutonPressed" onclick="window.location.href = \'../controllers/downVote.php?id=' . $idPost . '\'"></button>';
                            }
                            else {
                                echo '<button id="UpVoteBouton" onclick="window.location.href = \'../controllers/upVote.php?id=' . $idPost . '\'"></button>';
                                echo '<button id="DownVoteBouton" onclick="window.location.href = \'../controllers/downVote.php?id=' . $idPost . '\'"></button>';
                            }
                        }
                        else {
                            echo '<button id="UpVoteBouton" onclick="window.location.href = \'../controllers/upVote.php?id=' . $idPost . '\'"></button>';
                            echo '<button id="DownVoteBouton" onclick="window.location.href = \'../controllers/downVote.php?id=' . $idPost . '\'"></button>';
                        }
                    ?>
                </div>
                <div class="commentairesPostDiv">
                    <button class="CommentaireBouton" onclick="window.location.href = 'viewPoste.php?id=<?php echo $idPost?>'"></button>
                    <label> <?php echo $nb_comm; ?> </label>
                </div>
                <?php
                if(isset($_SESSION['username']) and $_SESSION['username'] === $croustagrameurId){
                    echo '<button id="boutonSupprimerPost" onclick="window.location.href = ' . '\'../models/deleteCommsAndPosts.php?postId=' . $idPost . '\' ">Supprimer le poste</button>';
                }
                ?>
            </div>

    </div>

    <?php
}

function showOnePost($id){

    $data = getOnePostData($id);

    $post = ' ';

    $row = $data->fetch(PDO::FETCH_ASSOC);

    $accountData = getAllCompteData($row['croustagrameur_id']);
    $account = $accountData->fetch(PDO::FETCH_ASSOC);
    $accountName = $account['pseudo'];

    if (!empty($row)){
        $nb_comm = getNbCommentaires($row['id']);

        return $post . showPost($row['croustagrameur_id'], $accountName, $row['titre'], $row['message'], $row['date'], $row['categorie1'], $row['categorie2'], $row['categorie3'], $row['ptsCrous'], $row['id'], $nb_comm);
    }
    else return 0;
}

function showAllPosts($ordre = 'id'){
    $posts = ' ';

    $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
    $data = getAllPostsId($ordre);
    echo '<div id="allPosts">';
    if ($isMob) {
        if (isset($_SESSION['username'])) { ?>
            <button id="BoutonCreerPost"></button>
        <?php }
    }
    while($row = $data->fetch(PDO::FETCH_ASSOC)){
        $posts = $posts . showOnePost($row['id']);
    }
    echo '</div>';

    return $posts;
}

function afficherPostSelonCategorie($catFiltre) {
    // Connexion à la base de donnée
    $connexion = connexion();

    // Requête
    if($catFiltre == 0){
        $requete = 'SELECT id FROM croustapost WHERE categorie1 = 0 AND categorie2 = 0 AND categorie3 = 0';
        $nb = "SELECT COUNT(*) FROM croustapost WHERE categorie1 = 0 AND categorie2 = 0 AND categorie3 = 0";
    }
    else {
        $requete = 'SELECT id FROM croustapost WHERE categorie1 = ' . $catFiltre .' OR categorie2 = ' . $catFiltre . ' OR categorie3 = ' . $catFiltre;
        $nb = 'SELECT COUNT(DISTINCT id) FROM croustapost WHERE categorie1 = ' . $catFiltre .' OR categorie2 = ' . $catFiltre . ' OR categorie3 = ' . $catFiltre;
    }
    // Envoie de la requête
    $result = $connexion->query($requete);

    // Affichage du résultat de la requête
    afficherNbResult($nb);

    // Affichage des posts
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        showOnePost($row['id']);
    }
}

function afficherPostSelonMot($text) {
    if (empty($text)){
        $requete = "SELECT * FROM croustapost ORDER BY ptsCrous DESC";
        $nb = "SELECT COUNT(*) FROM croustapost";
    }
    else{
        $requete = "SELECT DISTINCT cp.id, cp.croustagrameur_id, cp.titre, cp.message, cp.date, cp.categorie1, cp.categorie2, cp.categorie3, cp.ptsCrous
                FROM croustapost cp, croustacomm cm, croustegorie cg
                WHERE (cm.croustapost_id = cp.id and cm.texte LIKE '%$text%')
                    OR (cp.message LIKE '%$text%' 
                        OR cp.titre LIKE '%$text%')
                    OR ((cg.id = cp.categorie1 OR cg.id = cp.categorie2 OR cg.id = cp.categorie3)
                        AND (cg.libelle LIKE '%$text%'))
                ORDER BY cp.ptsCrous DESC ";
        $nb = "SELECT COUNT(DISTINCT cp.id) FROM croustapost cp, croustacomm cm, croustegorie cg WHERE (cm.croustapost_id = cp.id and cm.texte LIKE '%$text%') OR (cp.message LIKE '%$text%' OR cp.titre LIKE '%$text%') OR ((cg.id = cp.categorie1 OR cg.id = cp.categorie2 OR cg.id = cp.categorie3) AND (cg.libelle LIKE '%$text%'))";
    }

    // Connexion à la base de donnée
    $connexion = connexion();
    $result = $connexion->query($requete);

    // Affichage du résultat de la requête
    afficherNbResult($nb);

    // Affichage des posts
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        showOnePost($row['id']);
    }
}

function afficherNbResult($nb) {
// Permet l'affichage du résultat de la requête

    $connexion = connexion();
    $nbFound = $connexion->query($nb);
    $nbFound = $nbFound->fetch();
    $nbFound = $nbFound[0];
    if($nbFound == 0) {
        $message = 'Aucun post ne correspond à votre recherche...' ;
    }
    else if ($nbFound == 1) {
        $message = '1 post correspond à votre recherche !' ;
    }
    else {
        $message = $nbFound . ' posts correspondent à votre recherche !' ;
    }
    echo '<h3>' . $message . '</h3><br><br>';
}

