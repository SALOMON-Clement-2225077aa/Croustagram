<?php
require_once 'controllerCompte.php';
require_once 'controllerCategorie.php';
require_once '../models/modelCompte.php';
require_once '../models/modelVote.php';
require_once '../models/modelAdmin.php';

/**
 * Fonction qui permet la structuration de l'affichage d'un post
 * @param $croustagrameurId = l'id de l'auteur du poste
 * @param $img = la pdp de l'auteur
 * @param $pseudo = son peudo
 * @param $titre =  le titre du post
 * @param $message = le contenu du poste
 * @param $date = la date de création du poste
 * @param $categorie1 = la catégorie 1
 * @param $categorie2 = la catégorie 2
 * @param $categorie3 = la catégorie 3
 * @param $ptsCrous = le nmbre de pts crous du post
 * @param $idPost = l'id du post
 * @param $nb_comm = le nombre de commentaires du poste
 * @return void
 */
function showPost($croustagrameurId, $img ,$pseudo, $titre, $message, $date, $categorie1, $categorie2, $categorie3, $ptsCrous, $idPost, $nb_comm): void
{
    ?>
    <div class="post">
            <div class="hautPostDiv">
                <div class="postUserDiv">
                    <?php
                    $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
                    if($isMob){
                        $MobLink = '_Mobile';
                    }
                    else{
                        $MobLink = '';
                    }
                    if($img == 'no_img') {
                        echo '<img draggable="false" alt="Photo de profil" onclick="window.location.href = \'viewCompte'. $MobLink .'.php?id=' . $croustagrameurId . '\';" src="../public/assets/images/profil.png" class="imgProfil" >';
                    }
                    else {
                        echo '<img draggable="false" alt="Photo de profil" onclick="window.location.href = \'viewCompte'. $MobLink .'.php?id=' . $croustagrameurId . '\';" src="'. $img .'" class="imgProfil" >';
                    }
                    ?>
                    <label class="nomUserPost"> <?php echo $pseudo ?> </label>
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
                                echo '<button class="UpVoteBoutonPressed" onclick="window.location.href = \'../controllers/upVote.php?id=' . $idPost . '\'"></button>';
                                echo '<button class="DownVoteBouton" onclick="window.location.href = \'../controllers/downVote.php?id=' . $idPost . '\'"></button>';
                            }
                            else if($boolDown == 1) {
                                echo '<button class="UpVoteBouton" onclick="window.location.href = \'../controllers/upVote.php?id=' . $idPost . '\'"></button>';
                                echo '<button class="DownVoteBoutonPressed" onclick="window.location.href = \'../controllers/downVote.php?id=' . $idPost . '\'"></button>';
                            }
                            else {
                                echo '<button class="UpVoteBouton" onclick="window.location.href = \'../controllers/upVote.php?id=' . $idPost . '\'"></button>';
                                echo '<button class="DownVoteBouton" onclick="window.location.href = \'../controllers/downVote.php?id=' . $idPost . '\'"></button>';
                            }
                        }
                        else {
                            echo '<button class="UpVoteBouton" onclick="window.location.href = \'../controllers/upVote.php?id=' . $idPost . '\'"></button>';
                            echo '<button class="DownVoteBouton" onclick="window.location.href = \'../controllers/downVote.php?id=' . $idPost . '\'"></button>';
                        }
                    ?>
                </div>
                <div class="commentairesPostDiv">
                    <?php
                    $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
                    if ($isMob) {
                        echo '<button class="CommentaireBouton" onclick="window.location.href =\'viewPost_Mobile.php?id=' . $idPost . '\'"></button>';
                    }
                    else {
                        echo '<button class="CommentaireBouton" onclick="window.location.href =\'viewPost.php?id=' . $idPost . '\'"></button>';
                    }
                    ?>
                    <label> <?php echo $nb_comm; ?> </label>
                </div>
                <?php
                if(isset($_SESSION['username']) and ($_SESSION['username'] === $croustagrameurId or isAdmin($_SESSION['username'])) ){
                    echo '<button class="button-suppr" onclick="window.location.href = ' . '\'../models/deleteCommsAndPosts.php?postId=' . $idPost . '\' ">Supprimer le post</button>';
                }
                ?>
            </div>
    </div>

    <?php
}

/**
 * Fonction qui permet l'affichage d'un post
 * @param $id = l'id du post
 * @return int|string
 */
function showOnePost($id){

   // On prend la data d'un post
   $data = getOnePostData($id);

    $post = ' ';

    $row = $data->fetch(PDO::FETCH_ASSOC);

    $accountData = getAllCompteData($row['croustagrameur_id']);
    $account = $accountData->fetch(PDO::FETCH_ASSOC);
    $accountName = $account['pseudo'];
    $accountImg = $account['img'];

    if (!empty($row)){
        $nb_comm = getNbCommentaires($row['id']);

        return $post . showPost($row['croustagrameur_id'], $accountImg, $accountName, $row['titre'], $row['message'], $row['date'], $row['categorie1'], $row['categorie2'], $row['categorie3'], $row['ptsCrous'], $row['id'], $nb_comm);
    }
    else return 0;
}

/**
 * @param $ordre
 * @param $limit
 * @return string
 * Fonction qui permet l'affichage de tous les posts contenus dans la base de donnée (limité au 50 plus récents)
 */
function showAllPosts($ordre = 'id', $limit = 50){
    $posts = ' ';
    $data = getAllPostsId($ordre);

    $isMob = is_numeric(strpos(strtolower($_SERVER["HTTP_USER_AGENT"]), "mobile"));
    echo '<div id="allPosts">';
    if ($isMob) {
        if (isset($_SESSION['username'])) { ?>
            <button id="BoutonCreerPost" onclick="window.location.href = '../views/viewCreerPost_Mobile.php'"></button>
        <?php
        }
    }
    $cpt = 0;
    while($row = $data->fetch(PDO::FETCH_ASSOC)){
        $posts = $posts . showOnePost($row['id']);
        $cpt +=1;
        if($cpt >= $limit) {
            break;
        }
    }
    echo '</div>';

    return $posts;
}

/**
 * @param $catFiltre
 * @return void
 * Fonction qui permet l'affichage des posts avec la catégorie en paramètre
 */
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

    // Affichage des posts
    echo '<div id="allPosts">';
    // Affichage du résultat de la requête
    afficherNbResult($nb);
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        showOnePost($row['id']);
    }
    echo '</div>';
}

/**
 * @param $text
 * @return void
 * Fonction qui affiche tout les posts contenant le mot/expression en paramètre
 */
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
                        OR cp.titre LIKE '%$text%'
                        OR cp.date LIKE '%$text%'
                        OR cp.croustagrameur_id LIKE '%$text%')
                        OR ((cg.id = cp.categorie1 OR cg.id = cp.categorie2 OR cg.id = cp.categorie3)
                            AND (cg.libelle LIKE '%$text%' OR cg.description LIKE '%$text%'))
                            ORDER BY cp.ptsCrous DESC";
        $nb = "SELECT COUNT(DISTINCT cp.id) FROM croustapost cp, croustacomm cm, croustegorie cg WHERE (cm.croustapost_id = cp.id and cm.texte LIKE '%$text%') OR (cp.message LIKE '%$text%' OR cp.titre LIKE '%$text%' OR cp.date LIKE '%$text%' OR cp.croustagrameur_id LIKE '%$text%') OR ((cg.id = cp.categorie1 OR cg.id = cp.categorie2 OR cg.id = cp.categorie3) AND (cg.libelle LIKE '%$text%' OR cg.description LIKE '%$text%'))";
    }

    // Connexion à la base de donnée
    $connexion = connexion();
    $result = $connexion->query($requete);

    // Affichage des posts
    echo '<div id="allPosts">';
    // Affichage du résultat de la requête
    afficherNbResult($nb);
    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        showOnePost($row['id']);
    }
    echo '</div>';
}

/**
 * @param $nb
 * @return void
 * Fonction qui permet l'affichage de la phrase qui indique
 * le nb de résultat de la recherche filtré
 */
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

