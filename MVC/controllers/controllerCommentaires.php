<?php
require '../models/modelCommentaires.php';
function showCommentaires($id){
    $result = getAllCommentaires($id);
    $commentaires = ' ';
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $commentaires . '<section id="commentaire">';
        $commentaires . showOneCommentaire($row['texte'], $row['croustagrameur_id'], $row['date']);
        $commentaires . '</section>';
    }
    return $commentaires;
}

function showOneCommentaire($texte, $croustagrameur_id, $date){
    ?>
    <br>
    <form action="../managePost/pagePost.php" >
        <div id="commentaire" style="margin-bottom: 25px">
            <table id="tabPost">
                <tr>
                    <th><img <?php echo 'onclick="window.location.href = \'viewCompte.php?id=' . $croustagrameur_id . '\';"' ?> src="../public/assets/images/profil.png" id="imgProfil" > <?php echo $croustagrameur_id ?></a></th>
                    <th><?php
                        echo $date;
                        ?></th>
                </tr>
                <tr>
                    <th colspan="3">
                        <h2> <?php echo wordwrap($texte, 30, '<br>', true) ?> </h2>
                    </th>
                </tr>
                <tr>
                    <th>
                        <button onclick="upVote()"> <img src="../public/assets/images/fleche-vers-le-haut.png" id="imgProfil"> </button>
                        <button onclick="downVote()"> <img src="../public/assets/images/fleche-vers-le-bas.png" id="imgProfil"> </button>
                    </th>
                </tr>
            </table>
        </div>
    </form>
<?php
}

function showinterfaceAjoutCommentaire(){
    ?>
    <form action="../controllers/addComment.php?id=<?php echo $_GET['id'] ?>" method="post">
        <div id="addComment">
            <textarea name="commentContent" placeholder="Contenu du commentaire" class="commentBox" rows="6" cols="50"></textarea>
            <br><br>
            <button type="submit">Ajouter un commentaire</button>
        </div>
    </form>
    <?php
}
