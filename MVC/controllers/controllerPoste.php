<?php
require_once 'controllerCompte.php';
require_once '../models/modelCompte.php';
require_once 'controllerCategorie.php';

function showPost($croustagrameurId, $titre, $message, $date, $categorie1, $categorie2, $categorie3, $ptsCrous, $idPost, $nb_comm): void
{
    ?>
    <div id="post" style="margin-bottom: 25px">

            <div id="hautPostDiv">
                <div id="postUserDiv">
                    <img <?php echo 'onclick="window.location.href = \'viewCompte.php?id=' . $croustagrameurId . '\';"' ?> src="../public/assets/images/profil.png" id="imgProfil" >
                    <label id="nomUserPost"> <?php echo $croustagrameurId ?> </label>
                </div>
                <label id="datePost"> <?php echo $date ?> </label>
            </div>

            <h1 id="titrePost"> <?php echo $titre ?> </h1>

            <h2 id="messagePost"> <?php echo wordwrap($message, 50, '<br>', true) ?> </h2>

            <?php $les_categories = convert_cat($categorie1, $categorie2, $categorie3) ?>
            <label id="categoriesPost"> <?php echo $les_categories ?> </label>

            <div id="basPostDiv">
                <div id="votesPostDiv">
                    <label id="pointCrousLabelPost"> <?php echo $ptsCrous ?> </label>
                    <button id="UpVoteBouton" onclick="window.location.href = '../controllers/upVote.php?id=<?php echo $idPost?>'"></button>
                    <button id="DownVoteBouton" onclick="window.location.href = '../controllers/downVote.php?id=<?php echo $idPost ?>'"></button>
                </div>
                <div id="commentairesPostDiv">
                    <button id="CommentaireBouton" onclick="window.location.href = 'viewPoste.php?id=<?php echo $idPost?>'"></button>
                    <label> <?php echo $nb_comm; ?> </label>
                </div>
                <?php
                if(isset($_SESSION['username']) and $_SESSION['username'] === $croustagrameurId){
                    echo '<button onclick="window.location.href = ' . '\'../models/deleteCommsAndPosts.php?postId=' . $idPost . '\' ">Supprimer le poste</button>';
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
    $nb_comm = getNbCommentaires($row['id']);

    $post = $post . showPost($row['croustagrameur_id'], $row['titre'], $row['message'], $row['date'], $row['categorie1'], $row['categorie2'], $row['categorie3'], $row['ptsCrous'], $row['id'], $nb_comm);


    return $post;
}

function showAllPosts(){
    $posts = ' ';

    $data = getAllPostsId();

    while($row = $data->fetch(PDO::FETCH_ASSOC)){
        $posts = $posts . showOnePost($row['id']);
    }

    return $posts;
}