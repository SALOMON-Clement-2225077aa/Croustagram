<?php
require_once 'controllerCompte.php';
require_once '../models/modelCompte.php';
require_once 'controllerCategorie.php';

function showPost($croustagrameurId, $titre, $message, $date, $categorie1, $categorie2, $categorie3, $ptsCrous, $idPost, $nb_comm): void
{
    ?>
    <div id="post" style="margin-bottom: 25px">
        <table id="tabPost">
            <tr>
                <th style="left: -10px">
                    <img <?php echo 'onclick="window.location.href = \'viewCompte.php?id=' . $croustagrameurId . '\';"' ?> src="../public/assets/images/profil.png" id="imgProfil" > <?php echo $croustagrameurId ?></a>
                </th>
                <th id="titrePost"><?php
                    echo '<h1>' . $titre . '</h1>';
                    ?></th>
                <th><?php
                    echo $date;
                    ?></th>
            </tr>
            <tr>
                <th colspan="3">
                    <h2> <?php echo wordwrap($message, 30, '<br>', true) ?> </h2>
                </th>
            </tr>
            <tr>
                <th> <?php echo $ptsCrous ?>
                    <button onclick="window.location.href = '../controllers/upVote.php?id=<?php echo $idPost?>'"> <img src="../public/assets/images/fleche-vers-le-haut.png" id="imgProfil"> </button>
                    <button onclick="window.location.href = '../controllers/downVote.php?id=<?php echo $idPost ?>'"> <img src="../public/assets/images/fleche-vers-le-bas.png" id="imgProfil"> </button>
                </th>
                <?php $les_categories = convert_cat($categorie1, $categorie2, $categorie3) ?>
                <th> <?php echo $les_categories ?> </th>
                <th>
                    <a href="viewPoste.php?id=<?php echo $idPost?>">
                        <img src="../public/assets/images/commentaire.png" id="imgProfil"> <th> <?php echo $nb_comm; ?></th>
                    </a>
                </th>
            </tr>
        </table>
    </div>
    <?php
    if(isset($_SESSION['username']) and $_SESSION['username'] === $croustagrameurId){
        echo '<button onclick="window.location.href = ' . '\'../models/deleteCommsAndPosts.php?postId=' . $idPost . '\' ">Supprimer le poste</button>';
    }
    ?>
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