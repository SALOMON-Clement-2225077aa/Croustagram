<?php

require_once 'controllerCompte.php';

function showPost($croustagrameur, $titre, $message, $date, $categorie1, $categorie2, $categorie3, $ptsCrous, $idPost, $nb_comm): void
{
    ?>
    <form action="../managePost/pagePost.php" >
        <div id="post" style="margin-bottom: 25px">
            <table id="tabPost">
                <tr>
                    <th><img <?php echo 'onclick="window.location.href = \'viewCompte.php?id=' . $croustagrameur . '\';"' ?> src="../public/assets/images/profil.png" id="imgProfil" > <?php echo $croustagrameur ?></a></th>
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
                        <button onclick="upVote()"> <img src="../public/assets/images/fleche-vers-le-haut.png" id="imgProfil"> </button>
                        <button onclick="downVote()"> <img src="../public/assets/images/fleche-vers-le-bas.png" id="imgProfil"> </button>
                    </th>
                    <th> <?php echo $categorie1 . ', ' ; echo $categorie2 . ', ' ; echo $categorie3 ?> </th>
                    <th>
                        <a href="viewPoste.php?id=<?php echo $idPost?>">
                            <img src="../public/assets/images/commentaire.png" id="imgProfil"> <th> <?php echo $nb_comm; ?></th>
                        </a>
                    </th>
                </tr>
            </table>
        </div>
    </form>
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