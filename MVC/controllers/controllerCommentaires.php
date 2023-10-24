<?php
require_once '../models/modelCommentaires.php';
require_once '../models/modelCompte.php';
function showCommentaires($id){
    $result = getAllCommentaires($id);
    $commentaires = ' ';



    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $accountData = getAllCompteData($row['croustagrameur_id']);
        $account = $accountData->fetch(PDO::FETCH_ASSOC);
        $accountName = $account['pseudo'];

        $commentaires . '<section id="commentaire">';
        $commentaires . showOneCommentaire($row['texte'], $row['croustagrameur_id'], $accountName, $row['date'], $row['id'], $row['croustapost_id']);
        $commentaires . '</section>';
    }
    return $commentaires;
}

function showOneCommentaire($texte, $croustagrameur_id, $pseudo, $date, $id, $idPost){
    ?>
    <br>
        <div id="commentaire" style="margin-bottom: 25px">
            <div id="hautCommentaireDiv">
                <div class="postUserDiv">
                    <img <?php echo 'onclick="window.location.href = \'viewCompte.php?id=' . $croustagrameur_id . '\';"' ?> src="../public/assets/images/profil.png" id="imgProfilCommentaire">
                    <label class="nomUserPost"> <?php echo $pseudo ?> </label>
                </div>
                <label> <?php echo $date ?> </label>
            </div>

            <label id="messageCommentaire"> <?php echo wordwrap($texte, 30, '<br>', true) ?> </label>

            <?php
            if(isset($_SESSION['username']) and $_SESSION['username'] === $croustagrameur_id){
                echo '<button onclick="window.location.href = ' . '\'../models/deleteCommsAndPosts.php?postId=' . $idPost . '&commId=' . $id . '\' ">Supprimer le commentaire</button><br>';
            }
            ?>
        </div>
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
